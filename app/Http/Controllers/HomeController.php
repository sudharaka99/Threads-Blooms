<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->where('is_active', true)
            ->take(8)
            ->get();

        // If no featured products, get some products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')
                ->where('is_active', true)
                ->take(8)
                ->get();
        }

        // Define demo products (fallback)
        $demoProducts = $this->getDemoProducts();

        // Get categories for display
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->take(4)
            ->get();

        // Get recent reviews
        $reviews = Review::with('user')
            ->where('status', 'approved')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'featuredProducts', 
            'categories', 
            'reviews',
            'demoProducts'
        ));
    }

    // public function index()
    // {
    //     return view('home');
    // }

    private function getDemoProducts()
    {
        return collect([
            (object) [
                'name' => 'Floral Bouquet',
                'type' => 'Cross-Stitch Pattern',
                'price' => 1200,
                'image' => 'products/floral-bouquet.jpg'
            ],
            (object) [
                'name' => 'Sleepy Cat',
                'type' => 'Cross-Stitch Pattern',
                'price' => 1200,
                'image' => 'products/sleepy-cat.jpg'
            ],
            (object) [
                'name' => 'Lavender Dreams',
                'type' => 'Cross-Stitch Pattern',
                'price' => 1200,
                'image' => 'products/lavender-dreams.jpg'
            ],
            (object) [
                'name' => 'Floral Vine',
                'type' => 'Embroidered T-Shirt',
                'price' => 2400,
                'image' => 'products/floral-vine.jpg'
            ],
            (object) [
                'name' => 'Wild Flowers',
                'type' => 'Embroidered T-Shirt',
                'price' => 2400,
                'image' => 'products/wild-flowers.jpg'
            ],
            (object) [
                'name' => 'Initial Bloom',
                'type' => 'Embroidered T-Shirt',
                'price' => 2400,
                'image' => 'products/initial-bloom.jpg'
            ],
        ]);
    }
}