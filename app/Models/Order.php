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
    ];

    protected $casts = [
        'subtotal' => 'integer',
        'service_fee_amount' => 'integer',
        'tax_amount' => 'integer',
        'total_price' => 'integer',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
