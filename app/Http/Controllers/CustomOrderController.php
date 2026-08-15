<?php
// app/Http/Controllers/CustomOrderController.php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomOrderController extends Controller
{
    public function create()
    {
        return view('customize.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'design_description' => 'required|string',
            'design_image' => 'nullable|image|max:2048',
            'product_type' => 'required|in:tshirt,cross_stitch,other',
            'tshirt_size' => 'required_if:product_type,tshirt|string|nullable',
            'tshirt_color' => 'required_if:product_type,tshirt|string|nullable',
            'thread_colors' => 'nullable|array',
            'text_embroidery' => 'nullable|string|max:255',
            'font_style' => 'nullable|string|max:100',
            'placement' => 'nullable|string|max:100',
            'special_instructions' => 'nullable|string',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('design_image')) {
            $imagePath = $request->file('design_image')->store('custom-designs', 'public');
        }

        $customOrder = CustomOrder::create([
            'user_id' => Auth::id(),
            'order_number' => 'CUS-' . strtoupper(Str::random(8)),
            'design_description' => $request->design_description,
            'design_image' => $imagePath,
            'product_type' => $request->product_type,
            'tshirt_size' => $request->tshirt_size,
            'tshirt_color' => $request->tshirt_color,
            'thread_colors' => $request->thread_colors,
            'text_embroidery' => $request->text_embroidery,
            'font_style' => $request->font_style,
            'placement' => $request->placement,
            'special_instructions' => $request->special_instructions,
            'status' => 'pending',
        ]);

        return redirect()->route('custom-orders.show', $customOrder)
            ->with('success', 'Your custom order has been submitted! We\'ll get back to you soon.');
    }

    public function index()
    {
        $customOrders = CustomOrder::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('custom-orders.index', compact('customOrders'));
    }

    public function show(CustomOrder $customOrder)
    {
        if ($customOrder->user_id != Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        return view('custom-orders.show', compact('customOrder'));
    }
}