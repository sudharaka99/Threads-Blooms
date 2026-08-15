<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with(['product', 'variant'])->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $tax = $subtotal * 0.08; // 8% tax
        $shipping = 250; // Flat shipping rate
        $total = $subtotal + $tax + $shipping;

        $user = Auth::user();

        return view('checkout.index', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total', 'user'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string',
            'billing_city' => 'required|string|max:100',
            'billing_province' => 'nullable|string|max:100',
            'billing_postal_code' => 'nullable|string|max:20',
            'billing_country' => 'required|string|max:100',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:100',
            'shipping_province' => 'nullable|string|max:100',
            'shipping_postal_code' => 'nullable|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'payment_method' => 'required|in:card,bank_transfer,cod',
            'same_as_billing' => 'sometimes|boolean',
            'notes' => 'nullable|string',
        ]);

        // If same as billing, copy billing info to shipping
        if ($request->has('same_as_billing')) {
            $request->merge([
                'shipping_name' => $request->billing_name,
                'shipping_email' => $request->billing_email,
                'shipping_phone' => $request->billing_phone,
                'shipping_address' => $request->billing_address,
                'shipping_city' => $request->billing_city,
                'shipping_province' => $request->billing_province,
                'shipping_postal_code' => $request->billing_postal_code,
                'shipping_country' => $request->billing_country,
            ]);
        }

        $cart = $this->getCart();
        $cartItems = $cart->items()->with(['product', 'variant'])->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $tax = $subtotal * 0.08;
        $shipping = 250;
        $total = $subtotal + $tax + $shipping;

        // Check for coupon
        $discount = 0;
        if (session()->has('coupon_code')) {
            $coupon = Coupon::where('code', session('coupon_code'))
                ->where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
                })
                ->first();

            if ($coupon) {
                if ($coupon->discount_type == 'percentage') {
                    $discount = ($subtotal * $coupon->discount_value) / 100;
                    if ($coupon->max_discount_amount && $discount > $coupon->max_discount_amount) {
                        $discount = $coupon->max_discount_amount;
                    }
                } else {
                    $discount = $coupon->discount_value;
                }
                
                $total = $total - $discount;
            }
        }

        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'discount_amount' => $discount,
                'total' => $total,
                'billing_name' => $request->billing_name,
                'billing_email' => $request->billing_email,
                'billing_phone' => $request->billing_phone,
                'billing_address' => $request->billing_address,
                'billing_city' => $request->billing_city,
                'billing_province' => $request->billing_province,
                'billing_postal_code' => $request->billing_postal_code,
                'billing_country' => $request->billing_country,
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_province' => $request->shipping_province,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_country' => $request->shipping_country,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'product_name' => $item->product->name,
                    'product_image' => $item->product->image,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->price * $item->quantity,
                ]);

                // Update product stock
                $product = $item->product;
                if ($product) {
                    $product->decrement('stock_quantity', $item->quantity);
                }

                // Update variant stock
                if ($item->variant_id) {
                    $variant = $item->variant;
                    if ($variant) {
                        $variant->decrement('stock_quantity', $item->quantity);
                    }
                }
            }

            // Clear cart
            $cart->items()->delete();

            // Save coupon usage if used
            if (isset($coupon) && $coupon) {
                $coupon->increment('used_count');
                $coupon->usages()->create([
                    'order_id' => $order->id,
                    'user_id' => Auth::id(),
                    'discount_amount' => $discount,
                ]);
                session()->forget('coupon_code');
            }

            // Process payment (simplified)
            if ($request->payment_method == 'cod') {
                $order->update(['payment_status' => 'pending']);
                $order->update(['status' => 'confirmed']);

                DB::commit();
                return redirect()->route('checkout.success', $order)
                    ->with('success', 'Order placed successfully!');
            }

            // For card and bank_transfer, redirect to payment gateway
            // This is a placeholder - integrate with your payment gateway
            DB::commit();

            return redirect()->route('checkout.success', $order)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }

    public function paymentCallback(Request $request)
    {
        // Handle payment gateway callback
        // Verify payment and update order status
        return response()->json(['status' => 'success']);
    }

    public function verifyPayment($transactionId)
    {
        // Verify payment status from gateway
        return redirect()->route('orders.index');
    }

    private function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }
        
        $sessionId = session()->get('cart_session_id');
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }
}