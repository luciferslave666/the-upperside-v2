<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'estimated_time')) {
                $table->integer('estimated_time')->nullable()->default(0)->comment('Estimasi waktu persiapan dalam menit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'estimated_time')) {
                $table->dropColumn('estimated_time');
            }
        });
    }
};
