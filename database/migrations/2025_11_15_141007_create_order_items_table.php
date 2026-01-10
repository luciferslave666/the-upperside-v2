<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_order_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel 'orders'
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            // Foreign Key ke tabel 'products'
            $table->foreignId('product_id')->constrained('products');
            
            $table->integer('quantity');
            $table->integer('price'); // Harga satuan produk SAAT checkout
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};