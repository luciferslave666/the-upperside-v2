<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Table;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        // Pendapatan Hari Ini
        $revenueToday = Order::where('payment_status', 'success')
                             ->whereDate('created_at', Carbon::today())
                             ->sum('total_price');

        // Pesanan Masuk Hari Ini
        $ordersTodayCount = Order::whereDate('created_at', Carbon::today())
                                 ->count();

        // Pesanan Menunggu Pembayaran
        $pendingOrdersCount = Order::where('status', 'pending')
                                   ->count();

        // 4. Menu Terlaris
        $topSellingProducts = OrderItem::select(
                                'products.name as product_name',
                                DB::raw('SUM(order_items.quantity) as total_sold')
                              )
                              ->join('products', 'order_items.product_id', '=', 'products.id')
                              ->join('orders', 'order_items.order_id', '=', 'orders.id')
                              ->where('orders.payment_status', 'success')
                              ->groupBy('order_items.product_id', 'products.name')
                              ->orderBy('total_sold', 'desc')
                              ->take(5)
                              ->get();

        // QUICK STATS 

        // Total menu
        $totalMenu = Product::count();

        // Total meja
        $totalTables = Table::count();

        // Total karyawan 
        $totalStaff = User::where('role', 'staff')->count();


        // RETURN VIEW + DATA
        return view('dashboard', [
            'revenueToday'       => $revenueToday,
            'ordersTodayCount'   => $ordersTodayCount,
            'pendingOrdersCount' => $pendingOrdersCount,
            'topSellingProducts' => $topSellingProducts,
            'totalMenu'          => $totalMenu,
            'totalTables'        => $totalTables,
            'totalStaff'         => $totalStaff,
        ]);
    }
}
