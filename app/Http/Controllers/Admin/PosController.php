<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class PosController extends Controller
{
    /**
     * Menampilkan halaman Point of Sale (POS)
     */
    public function index(): View
    {
        $statuses = ['pending', 'paid', 'processing'];
        
        $orders = Order::whereIn('status', $statuses)
                       ->with('table', 'orderItems.product') 
                       ->latest()
                       ->get();

        $pendingOrders = $orders->where('status', 'pending');
        $paidOrders = $orders->where('status', 'paid');
        $processingOrders = $orders->where('status', 'processing');

        return view('pos.index', [
            'pendingOrders' => $pendingOrders,
            'paidOrders' => $paidOrders,
            'processingOrders' => $processingOrders,
        ]);
    }

    /**
     * Memperbarui status pesanan dari halaman POS.
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['paid', 'processing', 'completed']),
            ],
        ]);

        $order->status = $validated['status'];

        if ($validated['status'] == 'paid') {
            $order->payment_status = 'success';
        }

        $order->save();

        return redirect()->route('pos.index')->with('success', "Status Pesanan #{$order->id} berhasil diupdate!");
    }


    /**
     * Mengambil data pesanan dan mengembalikannya sebagai
     * view HTML partial untuk di-load oleh AJAX.
     */
    public function fetchKanbanData(): View
    {

        $statuses = ['pending', 'paid', 'processing'];
        
        $orders = Order::whereIn('status', $statuses)
                       ->with('table', 'orderItems.product')
                       ->latest()
                       ->get();

        $pendingOrders = $orders->where('status', 'pending');
        $paidOrders = $orders->where('status', 'paid');
        $processingOrders = $orders->where('status', 'processing');

        return view('pos._kanban-board', [
            'pendingOrders' => $pendingOrders,
            'paidOrders' => $paidOrders,
            'processingOrders' => $processingOrders,
        ]);
    }
}   