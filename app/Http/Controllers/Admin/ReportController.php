<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\View\View;
use Carbon\Carbon; // <-- Import Carbon untuk manajemen tanggal
use Illuminate\Support\Facades\DB; // <-- 1. JANGAN LUPA TAMBAHKAN INI

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan penjualan.
     */
    public function index(Request $request): View
    {
        // 1. Ambil tanggal dari request, jika tidak ada, gunakan default (hari ini)
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        // 2. Query dasar: hanya ambil pesanan yang SUDAH SELESAI
        $query = Order::where('status', 'completed')
                      ->with('table'); // Ambil info meja

        // 3. Terapkan filter tanggal (whereBetween)
        // Kita gunakan DB::raw('DATE(created_at)') untuk memastikan kita hanya membandingkan tanggal, bukan jam
        $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);

        // 4. Ambil semua pesanan yang cocok
        $orders = $query->latest()->get();

        // 5. Hitung total pendapatan dan total pesanan dari hasil query
        $totalRevenue = $orders->sum('total_price');
        $totalOrders = $orders->count();

        // 6. Kirim semua data ke view
        return view('admin.reports.index', [
            'orders' => $orders,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}