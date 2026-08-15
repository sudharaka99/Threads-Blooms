<?php
// app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');

        $products = Product::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->with('category')
            ->latest()
            ->paginate(20);

        return view('search.results', compact('products', 'query'));
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('q', '');

        $products = Product::where('is_active', true)
            ->where('name', 'LIKE', "%{$query}%")
            ->take(10)
            ->get(['id', 'name', 'price', 'image']);

        return response()->json($products);
    }
}