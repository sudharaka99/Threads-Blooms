<?php
// app/Models/Cart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Accessors
    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }

    public function getItemCountAttribute()
    {
        return $this->items->count();
    }

    // Scopes
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    // Helper methods
    public function clear()
    {
        $this->items()->delete();
    }

    public function isEmpty()
    {
        return $this->items()->count() === 0;
    }

    public function addItem($productId, $quantity = 1, $variantId = null, $customOrderId = null)
    {
        $product = Product::findOrFail($productId);
        $price = $product->price;

        if ($variantId) {
            $variant = ProductVariant::find($variantId);
            if ($variant && $variant->price) {
                $price = $variant->price;
            }
        }

        return $this->items()->create([
            'product_id' => $productId,
            'variant_id' => $variantId,
            'quantity' => $quantity,
            'price' => $price,
            'custom_order_id' => $customOrderId,
        ]);
    }
}