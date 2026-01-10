<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Kolom 'total_price' akan kita gunakan sebagai Grand Total
            
            // Kita tambahkan rinciannya setelah 'total_price'
            
            // Subtotal (Total harga produk sebelum pajak/layanan)
            $table->integer('subtotal')->default(0)->after('total_price');
            
            // Jumlah biaya layanan (misal: 5000)
            $table->integer('service_fee_amount')->default(0)->after('subtotal');
            
            // Jumlah pajak (misal: 11000)
            $table->integer('tax_amount')->default(0)->after('service_fee_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn(['subtotal', 'service_fee_amount', 'tax_amount']);
        });
    }
};