<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; 
use Cart; 

class CustomerOrderController extends Controller
{
    /**
     * Menampilkan form awal pemesanan.
     */
    public function showStartForm(): View
    {
        $tables = Table::orderBy('name')->get();
        return view('order.start', [
            'tables' => $tables
        ]);
    }

    /**
     * Memproses Form Awal.
     * Memvalidasi dan menyimpan data awal pesanan ke session.
     */
    public function handleStartForm(Request $request): RedirectResponse
    {
        // 1. Validasi data
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'number_of_people' => 'required|integer|min:1',
            'table_id' => 'required|exists:tables,id',
        ]);

        // 2. Simpan data ke session
        $request->session()->put('order_details', [
            'customer_name' => $validated['customer_name'],
            'number_of_people' => $validated['number_of_people'],
            'table_id' => $validated['table_id'],
        ]);

        // 3. Arahkan ke halaman menu
        return redirect()->route('order.menu');
    }

    /**
     * Menampilkan halaman menu.
     * PERBAIKAN TIPE RETURN: Tambahkan RedirectResponse
     */
    public function showMenu(): View|RedirectResponse
    {
        if (!session()->has('order_details')) {
            return redirect()->route('order.start');
        }

        // TENTUKAN ID KERANJANG (DARI ID MEJA)
        $tableId = session('order_details.table_id');

        // AMBIL DATA KERANJANG
        $cartTotalQuantity = Cart::session($tableId)->getTotalQuantity();

        // Ambil data menu
        $categories = Category::with('products')->get();
        
        // KIRIM DATA KERANJANG KE VIEW
        return view('order.menu', [
            'categories' => $categories,
            'cartTotalQuantity' => $cartTotalQuantity 
        ]);
    }
    /**
 * Menampilkan form order berdasarkan QR Code meja
 */
public function orderByQr(string $qrCode): View|RedirectResponse
{
    // Cari table berdasarkan QR Code
    $table = Table::where('qr_code', $qrCode)->first();

    if (!$table) {
        return redirect()->route('order.start')
            ->with('error', 'QR Code tidak valid atau meja tidak ditemukan.');
    }

    // Set meja langsung di session
    session()->put('order_details', [
        'table_id' => $table->id,
        'customer_name' => null, // Akan diisi di halaman berikutnya
        'number_of_people' => null,
    ]);

    // Arahkan ke halaman yang minta nama & jumlah orang
    return redirect()->route('order.byQr.form');
}

/**
 * Tampilkan form isian nama dan jumlah orang (untuk QR scan)
 */
public function showQrForm(): View|RedirectResponse
{
    if (!session()->has('order_details') || !session('order_details.table_id')) {
        return redirect()->route('order.start')
            ->with('error', 'Sesi Anda tidak valid.');
    }

    $table = Table::find(session('order_details.table_id'));

    return view('order.qr-form', ['table' => $table]);
}

/**
 * Proses form dari QR scan
 */
public function handleQrForm(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'number_of_people' => 'required|integer|min:1',
    ]);

    // Update session dengan data yang baru diisi
    session()->put('order_details.customer_name', $validated['customer_name']);
    session()->put('order_details.number_of_people', $validated['number_of_people']);

    return redirect()->route('order.menu');
}
}