<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config; 
use Midtrans\Notification;

class WebhookController extends Controller
{
    /**
     * Menangani notifikasi webhook dari Midtrans.
     */
    public function handle(Request $request)
    {
        // 1. Set konfigurasi Midtrans
        // Ambil Server Key dari .env melalui file config/midtrans.php
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        // 2. Instance notifikasi Midtrans
        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            // Jika notifikasi gagal diproses
            return response()->json(['message' => 'Notifikasi tidak valid.'], 400);
        }

        // 3. Ambil detail notifikasi
        $order_id = $notification->order_id;
        $status_code = $notification->status_code;
        $gross_amount = $notification->gross_amount;
        $transaction_status = $notification->transaction_status;
        $payment_type = $notification->payment_type;
        $fraud_status = $notification->fraud_status;

        // 4. Verifikasi signature key (Keamanan)
        // Cocokkan signature key dari Midtrans dengan Server Key kita
        $signature_key = hash('sha512', $order_id . $status_code . $gross_amount . Config::$serverKey);
        if ($signature_key != $notification->signature_key) {
            // Jika signature tidak cocok, ini mungkin notifikasi palsu
            return response()->json(['message' => 'Signature tidak valid.'], 403);
        }

        // 5. Cari pesanan (order) di database kita
        $order = Order::find($order_id);

        if (!$order) {
            // Pesanan tidak ditemukan
            return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
        }

        // 6. Logika Update status pesanan
        if ($transaction_status == 'settlement') {
            
            // Cek apakah pesanan ini sudah 'paid' sebelumnya
            if ($order->status == 'paid') {
                return response()->json(['message' => 'Pesanan sudah diproses sebelumnya.'], 200);
            }

            // Update status pesanan di database
            $order->status = 'paid'; 
            $order->payment_status = 'success';
            $order->payment_gateway_token = $notification->transaction_id; 
            $order->save();
            
        } 

        
        // 7. Kirim respons "OK" (200) ke Midtrans
        // Ini WAJIB agar Midtrans tahu kita sudah menerima notifikasinya.
        return response()->json(['message' => 'Notifikasi berhasil diproses.'], 200);
    }
}