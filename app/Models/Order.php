<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'customer_name',
        'number_of_people',

        'subtotal',
        'service_fee_amount',
        'tax_amount',

        'total_price',
        'status',
        'payment_method',
        'payment_status',
        'payment_gateway_token',
        'notes',
        'estimated_time',
        'completed_at'
    ];

    protected $casts = [
        'subtotal' => 'integer',
        'service_fee_amount' => 'integer',
        'tax_amount' => 'integer',
        'total_price' => 'integer',
        'estimated_time' => 'integer',
        'completed_at' => 'datetime',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function calculateEstimatedTime(): int
    {
        if ($this->orderItems->isEmpty()) {
            return 0;
        }

        // Ambil estimated_time tertinggi dari semua products di order ini
        return $this->orderItems->max(function ($item) {
            return $item->product->estimated_time ?? 15; // Default 15 menit jika tidak ada
        });
    }

    /**
     * Method Helper: Cek apakah order sudah selesai
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed' && $this->completed_at !== null;
    }
}
