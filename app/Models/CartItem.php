<?php
// app/Models/CartItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
        'custom_order_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function customOrder()
    {
        return $this->belongsTo(CustomOrder::class);
    }

    // Accessors
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rs. ' . number_format($this->price, 2);
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rs. ' . number_format($this->total, 2);
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function getProductImageAttribute()
    {
        if ($this->variant && $this->variant->image) {
            return $this->variant->image_url;
        }
        return $this->product->image_url;
    }

    public function getVariantNameAttribute()
    {
        if ($this->variant) {
            return $this->variant->name;
        }
        return null;
    }

    public function getVariantAttributesAttribute()
    {
        if ($this->variant && $this->variant->attributes) {
            return $this->variant->attributes;
        }
        return [];
    }
}