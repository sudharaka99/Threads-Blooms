<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index', ['orders' => Order::with('user')->latest()->get()]);
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        return redirect()->back();
    }

    public function updateTracking(Request $request, Order $order)
    {
        return redirect()->back();
    }
}
