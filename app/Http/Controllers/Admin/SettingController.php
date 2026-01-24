<?php
// File: app/Http/Controllers/Admin/SettingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    public function index(): View
    {
        // firstOrCreate() untuk memastikan data ada.
        // Jika 'tax_percent' belum ada, buat baru dengan nilai '10' (10%).
        $tax = Setting::firstOrCreate(
            ['key' => 'tax_percent'],
            ['value' => '10'] 
        );

        // Jika 'service_percent' belum ada, buat baru dengan nilai '5' (5%).
        $service = Setting::firstOrCreate(
            ['key' => 'service_percent'],
            ['value' => '5']
        );

        return view('admin.settings.index', [
            'tax' => $tax,
            'service' => $service,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'tax_percent' => 'required|numeric|min:0|max:100',
            'service_percent' => 'required|numeric|min:0|max:100',
        ]);

        // updateOrCreate() untuk menyimpan pengaturan
        // (meng-update jika 'key' sudah ada, atau membuat baru jika belum)
        Setting::updateOrCreate(
            ['key' => 'tax_percent'],
            ['value' => $validated['tax_percent']]
        );

        Setting::updateOrCreate(
            ['key' => 'service_percent'],
            ['value' => $validated['service_percent']]
        );

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.products.index')->with('success', 'Pengaturan pajak & layanan berhasil disimpan!');
    }
}