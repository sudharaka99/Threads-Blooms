<?php
// app/Models/Coupon.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'used_count',
        'is_active',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Discount types
    const TYPE_PERCENTAGE = 'percentage';
    const TYPE_FIXED = 'fixed';

    // Relationships
    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    // Accessors
    public function getDiscountLabelAttribute()
    {
        if ($this->discount_type === self::TYPE_PERCENTAGE) {
            return $this->discount_value . '%';
        }
        return 'Rs. ' . number_format($this->discount_value, 2);
    }

    public function getIsValidAttribute()
    {
        return $this->isValid();
    }

    public function getRemainingUsesAttribute()
    {
        if ($this->usage_limit === null) {
            return 'Unlimited';
        }
        return max(0, $this->usage_limit - $this->used_count);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where(function ($q) {
                         $q->whereNull('starts_at')
                           ->orWhere('starts_at', '<=', now());
                     })
                     ->where(function ($q) {
                         $q->whereNull('expires_at')
                           ->orWhere('expires_at', '>=', now());
                     });
    }

    public function scopePercentage($query)
    {
        return $query->where('discount_type', self::TYPE_PERCENTAGE);
    }

    public function scopeFixed($query)
    {
        return $query->where('discount_type', self::TYPE_FIXED);
    }

    // Helper methods
    public function isValid()
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->starts_at && $this->starts_at > now()) {
            return false;
        }

        if ($this->expires_at && $this->expires_at < now()) {
            return false;
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    public function canBeAppliedTo($subtotal)
    {
        if (!$this->isValid()) {
            return false;
        }

        if ($this->min_order_amount && $subtotal < $this->min_order_amount) {
            return false;
        }

        return true;
    }

    public function calculateDiscount($subtotal)
    {
        if (!$this->canBeAppliedTo($subtotal)) {
            return 0;
        }

        if ($this->discount_type === self::TYPE_PERCENTAGE) {
            $discount = ($subtotal * $this->discount_value) / 100;
            if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
                $discount = $this->max_discount_amount;
            }
            return $discount;
        }

        return $this->discount_value;
    }

    public function incrementUsage()
    {
        $this->increment('used_count');
        return $this;
    }
}