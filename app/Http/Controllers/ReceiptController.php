<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    /**
     * Tampilkan struk untuk dicetak
     */
    public function show(Order $order): View
    {
        $order->load('table', 'orderItems.product');
        
        return view('receipts.receipt', ['order' => $order]);
    }

    /**
     * Print struk (AJAX dari POS)
     */
    public function print(Order $order)
    {
        $order->load('table', 'orderItems.product');
        
        return response()->json([
            'order_id' => $order->id,
            'customer_name' => $order->customer_name,
            'table' => $order->table->name,
            'items' => $order->orderItems->map(function($item) {
                return [
                    'name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->quantity * $item->price,
                ];
            }),
            'subtotal' => $order->subtotal,
            'service_fee' => $order->service_fee_amount,
            'tax' => $order->tax_amount,
            'total' => $order->total_price,
            'created_at' => $order->created_at->format('d/m/Y H:i:s'),
        ]);
    }
}