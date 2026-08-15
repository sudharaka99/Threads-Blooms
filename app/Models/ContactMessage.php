<?php
// app/Models/ContactMessage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_reply',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Status constants
    const STATUS_UNREAD = 'unread';
    const STATUS_READ = 'read';
    const STATUS_REPLIED = 'replied';

    // Accessors
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_UNREAD => 'Unread',
            self::STATUS_READ => 'Read',
            self::STATUS_REPLIED => 'Replied',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            self::STATUS_UNREAD => 'danger',
            self::STATUS_READ => 'warning',
            self::STATUS_REPLIED => 'success',
        ];
        return $colors[$this->status] ?? 'secondary';
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('status', self::STATUS_UNREAD);
    }

    public function scopeRead($query)
    {
        return $query->where('status', self::STATUS_READ);
    }

    public function scopeReplied($query)
    {
        return $query->where('status', self::STATUS_REPLIED);
    }

    // Helper methods
    public function markAsRead()
    {
        if ($this->status === self::STATUS_UNREAD) {
            $this->update(['status' => self::STATUS_READ]);
        }
        return $this;
    }

    public function markAsReplied($reply)
    {
        $this->update([
            'admin_reply' => $reply,
            'status' => self::STATUS_REPLIED,
            'replied_at' => now(),
        ]);
        return $this;
    }
}