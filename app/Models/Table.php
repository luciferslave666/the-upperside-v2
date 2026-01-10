<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Mendefinisikan relasi "satu-ke-banyak" dengan model Order.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}