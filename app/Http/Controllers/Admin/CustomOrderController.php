<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomOrderController extends Controller
{
    /**
     * Display customer's own custom orders.
     */
    public function index()
    {
        $orders = CustomOrder::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Show the custom order design form.
     */
    public function create()
    {
        // Get products (with error handling if table doesn't exist)
        try {
            $products = Product::where('is_active', true)->get();
        } catch (\Exception $e) {
            $products = collect([]);
        }
        
        // Get categories (with error handling if table doesn't exist)
        try {
            $categories = Category::where('is_active', true)->get();
        } catch (\Exception $e) {
            $categories = collect([]);
        }
        
        // Get customization options
        $customizationOptions = [
            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
            'colors' => [
                ['name' => 'White', 'code' => '#FFFFFF'],
                ['name' => 'Black', 'code' => '#000000'],
                ['name' => 'Red', 'code' => '#FF0000'],
                ['name' => 'Blue', 'code' => '#0000FF'],
                ['name' => 'Green', 'code' => '#00FF00'],
                ['name' => 'Yellow', 'code' => '#FFFF00'],
                ['name' => 'Pink', 'code' => '#FF69B4'],
                ['name' => 'Purple', 'code' => '#800080'],
                ['name' => 'Orange', 'code' => '#FFA500'],
                ['name' => 'Navy', 'code' => '#000080'],
            ],
            'materials' => ['Cotton', 'Polyester', 'Linen', 'Silk', 'Wool', 'Denim'],
            'styles' => ['Classic', 'Modern', 'Vintage', 'Minimalist', 'Boho'],
        ];
        
        // Return the correct view path - using 'customize.create' instead of 'customer.customize.create'
        return view('customize.create', compact(
            'categories',
            'products',
            'customizationOptions'
        ));
    }

    /**
     * Store a new custom order.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_id' => 'nullable|exists:products,id',
            'description' => 'required|string|min:10|max:2000',
            'quantity' => 'required|integer|min:1|max:100',
            'estimated_price' => 'required|numeric|min:0',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'material' => 'nullable|string|max:100',
            'style' => 'nullable|string|max:100',
            'customization_details' => 'nullable|string|max:2000',
            'reference_images' => 'nullable|array|max:5',
            'reference_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delivery_date' => 'nullable|date|after:today',
            'special_instructions' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle image uploads
        $referenceImages = [];
        if ($request->hasFile('reference_images')) {
            foreach ($request->file('reference_images') as $image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('custom-references', $imageName, 'public');
                $referenceImages[] = asset('storage/' . $path);
            }
        }

        // Build customization data
        $customizationData = [
            'size' => $request->size,
            'color' => $request->color,
            'material' => $request->material,
            'style' => $request->style,
            'customization_details' => $request->customization_details,
            'reference_images' => $referenceImages,
            'delivery_date' => $request->delivery_date,
            'special_instructions' => $request->special_instructions,
        ];

        // Create custom order
        $customOrder = CustomOrder::create([
            'user_id' => Auth::id() ?? null,
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'estimated_price' => $request->estimated_price,
            'final_price' => null,
            'status' => 'pending',
            'priority' => 'medium',
            'customization_data' => json_encode($customizationData),
            'notes' => $request->special_instructions,
            'order_number' => 'CO-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
        ]);

        // Send confirmation email (if mail configured)
        // try {
        //     Mail::to($customOrder->user->email)->send(new CustomOrderConfirmation($customOrder));
        // } catch (\Exception $e) {
        //     // Log error but continue
        // }

        return redirect()
            ->route('custom-orders.show', $customOrder)
            ->with('success', 'Your custom order has been submitted successfully! We will review it and get back to you soon.');
    }

    /**
     * Display a specific custom order.
     */
    public function show(CustomOrder $customOrder)
    {
        // Ensure user owns this order
        if ($customOrder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        $customOrder->load('user');
        $customizationData = json_decode($customOrder->customization_data, true) ?? [];
        $referenceImages = $customizationData['reference_images'] ?? [];
        
        // Status tracker steps
        $statusSteps = [
            'pending' => ['label' => 'Order Placed', 'icon' => 'fa-file-invoice'],
            'reviewing' => ['label' => 'Under Review', 'icon' => 'fa-magnifying-glass'],
            'approved' => ['label' => 'Approved', 'icon' => 'fa-check-circle'],
            'designing' => ['label' => 'Designing', 'icon' => 'fa-pencil-ruler'],
            'production' => ['label' => 'In Production', 'icon' => 'fa-gears'],
            'quality_check' => ['label' => 'Quality Check', 'icon' => 'fa-clipboard-check'],
            'shipping' => ['label' => 'Shipping', 'icon' => 'fa-truck'],
            'completed' => ['label' => 'Completed', 'icon' => 'fa-flag-checkered'],
            'rejected' => ['label' => 'Rejected', 'icon' => 'fa-xmark-circle'],
        ];

        $currentStepIndex = array_search($customOrder->status, array_keys($statusSteps));

        return view('customer.orders.show', compact(
            'customOrder',
            'customizationData',
            'referenceImages',
            'statusSteps',
            'currentStepIndex'
        ));
    }

    /**
     * Track order status.
     */
    public function track(CustomOrder $customOrder)
    {
        // Ensure user owns this order
        if ($customOrder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        $trackingData = [
            'status' => $customOrder->status,
            'status_label' => $customOrder->status_label,
            'created_at' => $customOrder->created_at,
            'updated_at' => $customOrder->updated_at,
            'estimated_completion' => $customOrder->estimated_completion,
            'notes' => $customOrder->notes,
        ];

        return view('customer.orders.track', compact('customOrder', 'trackingData'));
    }

    /**
     * Get estimated price based on customization.
     */
    public function estimatePrice(Request $request)
    {
        $basePrice = 500; // Default base price
        $totalPrice = 0;
        $breakdown = [];

        // Base price from product
        if ($request->product_id) {
            try {
                $product = Product::find($request->product_id);
                if ($product) {
                    $basePrice = $product->price ?? 500;
                }
            } catch (\Exception $e) {
                $basePrice = 500;
            }
        }
        
        $breakdown[] = [
            'item' => 'Base Product',
            'price' => $basePrice,
        ];

        // Size adjustment
        $sizeMultiplier = [
            'XS' => 0.9,
            'S' => 1.0,
            'M' => 1.0,
            'L' => 1.1,
            'XL' => 1.2,
            'XXL' => 1.3,
        ];
        $size = $request->size ?? 'M';
        $sizeAdjustment = $sizeMultiplier[$size] ?? 1.0;
        $sizePrice = $basePrice * ($sizeAdjustment - 1);
        
        if ($sizePrice > 0) {
            $breakdown[] = [
                'item' => "Size: {$size} (+" . round(($sizeAdjustment - 1) * 100) . "%)",
                'price' => $sizePrice,
            ];
        }

        // Material adjustment
        $materialPrices = [
            'Cotton' => 0,
            'Polyester' => 50,
            'Linen' => 100,
            'Silk' => 250,
            'Wool' => 150,
            'Denim' => 75,
        ];
        $material = $request->material ?? 'Cotton';
        $materialPrice = $materialPrices[$material] ?? 0;
        
        if ($materialPrice > 0) {
            $breakdown[] = [
                'item' => "Material: {$material}",
                'price' => $materialPrice,
            ];
        }

        // Custom design fee
        $designFee = 0;
        if ($request->customization_details && strlen($request->customization_details) > 50) {
            $designFee = 200;
            $breakdown[] = [
                'item' => 'Custom Design Fee',
                'price' => $designFee,
            ];
        }

        // Urgency fee
        $urgencyFee = 0;
        if ($request->urgency === 'urgent') {
            $urgencyFee = 300;
            $breakdown[] = [
                'item' => 'Urgent Processing',
                'price' => $urgencyFee,
            ];
        }

        $subtotal = $basePrice + $sizePrice + $materialPrice + $designFee + $urgencyFee;
        $quantity = $request->quantity ?? 1;
        $totalPrice = $subtotal * $quantity;

        return response()->json([
            'success' => true,
            'breakdown' => $breakdown,
            'subtotal' => $subtotal,
            'quantity' => $quantity,
            'total' => $totalPrice,
            'formatted_total' => 'Rs. ' . number_format($totalPrice, 2),
        ]);
    }
}