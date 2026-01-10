<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'is_available',
    ];

    /**
     * Mendefinisikan tipe data untuk atribut.
     */
    protected $casts = [
        'price' => 'integer',
        'is_available' => 'boolean',
    ];

    /**
     * Mendefinisikan relasi "banyak-ke-satu" dengan model Category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}