<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel 'tables'
            $table->foreignId('table_id')->constrained('tables');
            
            $table->string('customer_name')->nullable(); // Opsional
            $table->integer('total_price');
            
            $table->enum('status', [
                'pending',
                'paid',
                'processing',
                'completed',
                'cancelled'
            ])->default('pending');
            
            $table->enum('payment_method', ['counter', 'online', 'unpaid'])->default('unpaid');
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');
            
            $table->string('payment_gateway_token')->nullable(); // ID/Token dari Midtrans/Xendit
            $table->text('notes')->nullable(); // Catatan dari pelanggan
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};