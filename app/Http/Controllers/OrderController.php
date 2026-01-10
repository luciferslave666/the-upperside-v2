<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
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

        // 5. Hitung biaya layanan & pajak
        $service_fee_amount = round(($subtotal * $service_percent) / 100);
        $tax_base = $subtotal + $service_fee_amount;
        $tax_amount = round(($tax_base * $tax_percent) / 100);

        $grand_total = $tax_base + $tax_amount;

        // 6. Mulai database transaction
        DB::beginTransaction();

        try {
            // 7. Simpan ke tabel orders
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
            ]);

            // 8. Simpan list item
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'product_id'=> $item->id,
                    'quantity'  => $item->quantity,
                    'price'     => $item->price,
                ]);
            }

            // 9. Commit
            DB::commit();

            // 10. Redirect ke halaman sukses
            // (Kita akan pindahkan 'clear cart' ke halaman sukses)
            return redirect()->route('order.success', $order);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('cart.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman sukses (dan membersihkan session)
     */
    public function showSuccess(Order $order): View
    {
        // --- EDIT 3: TAMBAHKAN LOGIKA CLEAR CART DI SINI ---
        // Ini adalah tempat terbaik untuk membersihkan keranjang,
        // karena ini dipanggil setelah 'Bayar di Kasir' ATAU 'Bayar Online' sukses.
        if (session()->has('order_details')) {
            $tableId = session('order_details.table_id');
            Cart::session($tableId)->clear();
            session()->forget('order_details');
        }
        // --- BATAS EDIT 3 ---

        return view('order.success', [
            'order' => $order
        ]);
    }


    // --- EDIT 2: TAMBAHKAN FUNGSI BARU DI BAWAH INI ---

    /**
     * Memproses pesanan "Bayar Online" dan meminta Snap Token.
     */
    public function placeOrderOnline(Request $request)
    {
        // --- Langkah A: Buat Pesanan di Database (Sama seperti 'counter') ---
        if (!session()->has('order_details')) {
            return response()->json(['error' => 'Sesi Anda telah berakhir.'], 400);
        }

        $tableId = session('order_details.table_id');
        $orderDetails = session('order_details');
        $cartItems = Cart::session($tableId)->getContent();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Keranjang Anda kosong.'], 400);
        }

        // Lakukan perhitungan yang SAMA PERSIS dengan 'placeOrderCounter'
        $subtotal = Cart::session($tableId)->getTotal();
        $service_percent = (float) (Setting::where('key', 'service_percent')->first()->value ?? 0);
        $tax_percent     = (float) (Setting::where('key', 'tax_percent')->first()->value ?? 0);
        $service_fee_amount = round(($subtotal * $service_percent) / 100);
        $tax_base = $subtotal + $service_fee_amount;
        $tax_amount = round(($tax_base * $tax_percent) / 100);
        $grand_total = $tax_base + $tax_amount;
        
        $order = null;
        DB::beginTransaction();

        try {
            // Buat pesanan dengan status 'pending' dan 'online'
            $order = Order::create([
                'table_id'           => $orderDetails['table_id'],
                'customer_name'      => $orderDetails['customer_name'],
                'number_of_people'   => $orderDetails['number_of_people'],
                'subtotal'           => $subtotal,
                'service_fee_amount' => $service_fee_amount,
                'tax_amount'         => $tax_amount,
                'total_price'        => $grand_total,
                'status'             => 'pending', 
                'payment_method'     => 'online', // <-- Berbeda di sini
                'payment_status'     => 'pending',
            ]);

            // Siapkan array untuk item Midtrans
            $midtrans_items = [];

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'product_id'=> $item->id,
                    'quantity'  => $item->quantity,
                    'price'     => $item->price,
                ]);
                // Tambahkan item ke array untuk Midtrans
                $midtrans_items[] = [
                    'id'       => $item->id,
                    'price'    => $item->price,
                    'quantity' => $item->quantity,
                    'name'     => $item->name,
                ];
            }
            
            // Tambahkan Biaya Layanan sebagai 'item'
            if ($service_fee_amount > 0) {
                $midtrans_items[] = [
                    'id'       => 'SERVICE_FEE',
                    'price'    => $service_fee_amount,
                    'quantity' => 1,
                    'name'     => 'Biaya Layanan',
                ];
            }
            // Tambahkan Pajak sebagai 'item'
            if ($tax_amount > 0) {
                $midtrans_items[] = [
                    'id'       => 'TAX',
                    'price'    => $tax_amount,
                    'quantity' => 1,
                    'name'     => 'Pajak',
                ];
            }

            // --- Langkah B: Minta Token ke Midtrans ---

            // 1. Set Konfigurasi Midtrans (ambil dari file config/midtrans.php)
            Config::$serverKey = config('midtrans.server_key');
            Config::$clientKey = config('midtrans.client_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // 2. Siapkan parameter transaksi
            $params = [
                'transaction_details' => [
                    'order_id'     => $order->id, 
                    'gross_amount' => $grand_total, 
                ],
                'customer_details' => [
                    'first_name' => $orderDetails['customer_name'],
                ],
                'item_details' => $midtrans_items,
                'enabled_payments' => ['qris'],
            ];

            // 3. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // 4. Jika semua berhasil, commit database
            DB::commit();
            
            // 5. Kirim Snap Token ke JavaScript di frontend
            return response()->json([
                'snapToken' => $snapToken,
                'orderId'   => $order->id 
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Maaf, terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
