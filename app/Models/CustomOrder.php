<?php
// app/Models/CustomOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'design_description',
        'design_image',
        'product_type',
        'tshirt_size',
        'tshirt_color',
        'thread_colors',
        'text_embroidery',
        'font_style',
        'placement',
        'special_instructions',
        'status',
        'estimated_price',
        'final_price',
        'admin_notes',
    ];

    protected $casts = [
        'thread_colors' => 'array',
        'estimated_price' => 'decimal:2',
        'final_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    // Product types
    const TYPE_TSHIRT = 'tshirt';
    const TYPE_CROSS_STITCH = 'cross_stitch';
    const TYPE_OTHER = 'other';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_PENDING => 'Pending Review',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_SHIPPED => 'Shipped',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            self::STATUS_PENDING => 'warning',
            self::STATUS_APPROVED => 'success',
            self::STATUS_IN_PROGRESS => 'info',
            self::STATUS_COMPLETED => 'primary',
            self::STATUS_SHIPPED => 'info',
            self::STATUS_DELIVERED => 'success',
            self::STATUS_CANCELLED => 'danger',
        ];
        return $colors[$this->status] ?? 'secondary';
    }

    public function getProductTypeLabelAttribute()
    {
        $labels = [
            self::TYPE_TSHIRT => 'T-Shirt',
            self::TYPE_CROSS_STITCH => 'Cross Stitch',
            self::TYPE_OTHER => 'Other',
        ];
        return $labels[$this->product_type] ?? $this->product_type;
    }

    public function getDesignImageUrlAttribute()
    {
        if ($this->design_image) {
            return asset('storage/' . $this->design_image);
        }
        return null;
    }

    public function getPriceAttribute()
    {
        return $this->final_price ?? $this->estimated_price;
    }

    public function getFormattedPriceAttribute()
    {
        if ($this->price) {
            return 'Rs. ' . number_format($this->price, 2);
        }
        return 'To be determined';
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('product_type', $type);
    }

    // Helper methods
    public function canBeApproved()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function canBeStarted()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function canBeCompleted()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
        return $this;
    }
}