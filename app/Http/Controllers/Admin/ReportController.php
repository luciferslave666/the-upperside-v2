<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        // Ambil tanggal dari request, jika tidak ada, gunakan default (hari ini)
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        // Query dasar: hanya ambil pesanan yang SUDAH SELESAI
        $query = Order::where('status', 'completed')
                      ->with('table'); // Ambil info meja

        // Terapkan filter tanggal (whereBetween)
        // DB::raw('DATE(created_at)') untuk memastikan kita hanya membandingkan tanggal, bukan jam
        $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);

        // Ambil semua pesanan yang cocok
        $orders = $query->latest()->get();

        // Hitung total pendapatan dan total pesanan dari hasil query
        $totalRevenue = $orders->sum('total_price');
        $totalOrders = $orders->count();

        // Kirim semua data ke view
        return view('admin.reports.index', [
            'orders' => $orders,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}