<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TableController extends Controller
{
    /**
     * Menampilkan daftar semua meja.
     */
    public function index(): View
    {
        $tables = Table::latest()->get();
        return view('admin.tables.index', ['tables' => $tables]);
    }

    /**
     * Menampilkan form untuk membuat meja baru.
     */
    public function create(): View
    {
        return view('admin.tables.create');
    }

    /**
     * Menyimpan meja baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name',
        ], [
            'name.unique' => 'Nama meja ini sudah ada.'
        ]);

        // 2. Simpan
        Table::create($validated);

        // 3. Redirect
        return redirect()->route('admin.tables.index')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit meja.
     */
    public function edit(Table $table): View
    {
        return view('admin.tables.edit', ['table' => $table]);
    }

    /**
     * Memperbarui meja di database.
     */
    public function update(Request $request, Table $table): RedirectResponse
    {
        // 1. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name,' . $table->id,
        ], [
            'name.unique' => 'Nama meja ini sudah ada.'
        ]);
        
        // 2. Update
        $table->update($validated);

        // 3. Redirect
        return redirect()->route('admin.tables.index')->with('success', 'Nama meja berhasil diperbarui!');
    }

    /**
     * Menghapus meja dari database.
     */
    public function destroy(Table $table): RedirectResponse
    {
        // Hapus meja
        $table->delete();

        // Redirect
        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil dihapus!');
    }
}