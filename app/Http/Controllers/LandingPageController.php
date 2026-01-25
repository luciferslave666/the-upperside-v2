<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // Wajib import ini untuk query Agregat

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman landing page (homepage).
     */
    public function index(Request $request): View
    {
        // --- LOGIKA 1: Ambil 3 Produk Terlaris (Mingguan) ---
        // Kita hitung jumlah quantity dari tabel order_items, filter 7 hari terakhir, dan status order valid
        $topSellingProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.created_at', '>=', now()->subDays(7)) // Filter 1 Minggu
            ->whereIn('orders.status', ['paid', 'completed', 'prepared']) // Hanya order yang sah
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(3) // Ambil Top 3
            ->get();

        // --- LOGIKA 2: Fallback (Jika Penjualan Kosong/Kurang) ---
        // Jika data kurang dari 3 (misal toko baru buka atau minggu ini sepi),
        // kita isi slot kosong dengan produk yang available secara acak/terbaru.
        if ($topSellingProducts->count() < 3) {
            
            // Catat ID yang sudah terpilih agar tidak dobel
            $existingIds = $topSellingProducts->pluck('id')->toArray();
            
            // Hitung berapa kekurangannya
            $needed = 3 - $topSellingProducts->count();

            // Ambil produk tambahan
            $fallbackProducts = Product::whereNotIn('id', $existingIds)
                ->where('is_available', true)
                ->inRandomOrder() // Bisa diganti ->latest() jika ingin produk terbaru
                ->take($needed)
                ->get();

            // Set total_sold jadi 0 untuk produk fallback ini (agar tidak error di view)
            foreach($fallbackProducts as $p) { 
                $p->total_sold = 0; 
            }

            // Gabungkan produk terlaris + produk fallback
            $topSellingProducts = $topSellingProducts->merge($fallbackProducts);
        }

        // Ambil nomor meja jika ada di URL (opsional, untuk tombol "Mulai Pesan")
        $table = $request->query('table');

        // Kirim data ke view 'welcome' (atau 'landing' jika Anda pakai nama itu)
        // Variable kita namakan 'topSellingProducts' agar sesuai dengan Blade yang saya berikan sebelumnya
        return view('welcome', [
            'topSellingProducts' => $topSellingProducts,
            'table' => $table
        ]);
    }

    /**
     * Halaman Full Menu (semua kategori & produk)
     */
    public function fullMenu(): View
    {
        $categories = \App\Models\Category::with(['products' => function($q) {
            $q->where('is_available', true)->orderBy('name');
        }])->orderBy('name')->get();
        return view('full-menu', compact('categories'));
    }
}