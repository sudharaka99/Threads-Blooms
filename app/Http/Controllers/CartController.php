<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with(['product', 'variant'])->get();
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $total = $subtotal; // Add tax, shipping, discounts later

        return view('cart.index', compact('cartItems', 'subtotal', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check stock
        if ($product->stock_quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = $this->getCart();
        
        // Check if item already exists in cart
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            // Get price (use variant price if available)
            $price = $product->price;
            if ($request->variant_id) {
                $variant = $product->variants()->find($request->variant_id);
                if ($variant && $variant->price) {
                    $price = $variant->price;
                }
            }

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
                'price' => $price,
            ]);
        }

        // Update session cart count
        session(['cart_count' => $cart->items()->sum('quantity')]);

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        
        // Check stock
        $product = Product::find($cartItem->product_id);
        if ($product && $product->stock_quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        session(['cart_count' => $cartItem->cart->items()->sum('quantity')]);

        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        session(['cart_count' => $cartItem->cart->items()->sum('quantity')]);

        return back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        $cart = $this->getCart();
        $cart->items()->delete();

        session(['cart_count' => 0]);

        return back()->with('success', 'Cart cleared!');
    }

    private function getCart()
    {
        if (Auth::check()) {
            // For logged-in users, get or create cart
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['session_id' => null]
            );
        } else {
            // For guests, use session ID
            $sessionId = session()->get('cart_session_id');
            if (!$sessionId) {
                $sessionId = Str::random(40);
                session()->put('cart_session_id', $sessionId);
            }

            $cart = Cart::firstOrCreate(
                ['session_id' => $sessionId],
                ['user_id' => null]
            );
        }

        return $cart;
    }
}