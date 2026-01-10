<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Mendefinisikan tipe data untuk atribut.
     */
    protected $casts = [
        'quantity' => 'integer',
        'price' => 'integer',
    ];

    /**
     * Mendefinisikan relasi "banyak-ke-satu" dengan model Order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Mendefinisikan relasi "banyak-ke-satu" dengan model Product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}