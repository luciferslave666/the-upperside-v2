<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting; 
use Cart;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Proses "Bayar di Kasir"
     */
    public function placeOrderCounter(Request $request): RedirectResponse
    {
        // 1. Pastikan session order_details ada
        if (!session()->has('order_details')) {
            return redirect()->route('order.start')
                ->with('error', 'Sesi Anda telah berakhir, silakan mulai lagi.');
        }

        // 2. Ambil data dari session & cart
        $tableId = session('order_details.table_id');
        $orderDetails = session('order_details');
        $cartItems = Cart::session($tableId)->getContent();
        $subtotal = Cart::session($tableId)->getTotal();

        // 3. Cek keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('order.menu')
                ->with('error', 'Keranjang Anda kosong.');
        }

        // 4. Ambil setting pajak & layanan
        $service_percent = (float) (Setting::where('key', 'service_percent')->first()->value ?? 0);
        $tax_percent     = (float) (Setting::where('key', 'tax_percent')->first()->value ?? 0);

        // 5. Hitung biaya
        $service_fee_amount = round(($subtotal * $service_percent) / 100);
        $tax_base = $subtotal + $service_fee_amount;
        $tax_amount = round(($tax_base * $tax_percent) / 100);
        $grand_total = $tax_base + $tax_amount;

        // ✅ HITUNG ESTIMATED TIME (ambil yang paling lama)
        $estimatedTime = 0;
        foreach ($cartItems as $item) {
            $product = Product::find($item->id);
            if ($product && $product->estimated_time) {
                $estimatedTime = max($estimatedTime, $product->estimated_time);
            }
        }

        DB::beginTransaction();

        try {
            // 6. Simpan order
            $order = Order::create([
                'table_id'           => $orderDetails['table_id'],
                'customer_name'      => $orderDetails['customer_name'],
                'number_of_people'   => $orderDetails['number_of_people'],

                'subtotal'           => $subtotal,
                'service_fee_amount' => $service_fee_amount,
                'tax_amount'         => $tax_amount,
                'total_price'        => $grand_total,

                'status'             => 'pending',
                'payment_method'     => 'counter',
                'payment_status'     => 'pending',
                'estimated_time'     => $estimatedTime, // ✅ TAMBAHAN
            ]);

            // 7. Simpan item
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                ]);
            }

            DB::commit();

            return redirect()->route('order.success', $order);

} catch (\Exception $e) {
    DB::rollBack();

    \Log::error('Order Counter Error', [
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ]);

    return redirect()->route('order.menu')  // ← Ganti dari cart.index ke order.menu
        ->with('error', 'Gagal membuat order: ' . $e->getMessage());
}
    }

    /**
     * Halaman sukses
     */
    public function showSuccess(Order $order): View
    {
        if (session()->has('order_details')) {
            $tableId = session('order_details.table_id');
            Cart::session($tableId)->clear();
            session()->forget('order_details');
        }

        return view('order.success', compact('order'));
    }

    /**
     * Proses "Bayar Online"
     */
    public function placeOrderOnline(Request $request)
    {
        if (!session()->has('order_details')) {
            return response()->json(['error' => 'Sesi Anda telah berakhir.'], 400);
        }

        $tableId = session('order_details.table_id');
        $orderDetails = session('order_details');
        $cartItems = Cart::session($tableId)->getContent();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Keranjang Anda kosong.'], 400);
        }

        $subtotal = Cart::session($tableId)->getTotal();
        $service_percent = (float) (Setting::where('key', 'service_percent')->first()->value ?? 0);
        $tax_percent     = (float) (Setting::where('key', 'tax_percent')->first()->value ?? 0);

        $service_fee_amount = round(($subtotal * $service_percent) / 100);
        $tax_base = $subtotal + $service_fee_amount;
        $tax_amount = round(($tax_base * $tax_percent) / 100);
        $grand_total = $tax_base + $tax_amount;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'table_id'           => $orderDetails['table_id'],
                'customer_name'      => $orderDetails['customer_name'],
                'number_of_people'   => $orderDetails['number_of_people'],
                'subtotal'           => $subtotal,
                'service_fee_amount' => $service_fee_amount,
                'tax_amount'         => $tax_amount,
                'total_price'        => $grand_total,
                'status'             => 'pending',
                'payment_method'     => 'online',
                'payment_status'     => 'pending',
            ]);

            $midtrans_items = [];

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                ]);

                $midtrans_items[] = [
                    'id'       => $item->id,
                    'price'    => $item->price,
                    'quantity' => $item->quantity,
                    'name'     => $item->name,
                ];
            }

            if ($service_fee_amount > 0) {
                $midtrans_items[] = [
                    'id' => 'SERVICE',
                    'price' => $service_fee_amount,
                    'quantity' => 1,
                    'name' => 'Biaya Layanan',
                ];
            }

            if ($tax_amount > 0) {
                $midtrans_items[] = [
                    'id' => 'TAX',
                    'price' => $tax_amount,
                    'quantity' => 1,
                    'name' => 'Pajak',
                ];
            }

            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $grand_total,
                ],
                'customer_details' => [
                    'first_name' => $orderDetails['customer_name'],
                ],
                'item_details' => $midtrans_items,
                'enabled_payments' => ['qris'],
            ];

            $snapToken = Snap::getSnapToken($params);

            DB::commit();

            return response()->json([
                'snapToken' => $snapToken,
                'orderId' => $order->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
