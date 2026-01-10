<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; // <-- PENTING: Tambahkan ini
use App\Models\Category;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin Kafe',
            'email' => 'admin@kafe.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Karyawan Kasir',
            'email' => 'kasir@kafe.com',
            'role' => 'karyawan',
            'password' => bcrypt('password'),
        ]);

        // 1. Matikan Foreign Key Checks sementara
        // Ini penting agar kita bisa menghapus data kategori meskipun ada produk yang memakainya
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan Tabel (Reset Data)
        // PERINGATAN: Ini menghapus semua data produk dan kategori!
        Product::truncate();
        Category::truncate();

        // (Opsional) Jika ingin mereset meja juga:
        // \App\Models\Table::truncate();

        // 3. Nyalakan kembali Foreign Key Checks
        Schema::enableForeignKeyConstraints();

        // 4. Jalankan Seeder Anda yang sudah ada
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            // TableSeeder::class, 
        ]);
    }
}