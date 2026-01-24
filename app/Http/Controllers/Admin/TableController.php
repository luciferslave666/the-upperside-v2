<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TableController extends Controller
{
    public function index(): View
    {
        $tables = Table::latest()->get();
        return view('admin.tables.index', ['tables' => $tables]);
    }
    public function create(): View
    {
        return view('admin.tables.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name',
        ], [
            'name.unique' => 'Nama meja ini sudah ada.'
        ]);

        // Simpan
        Table::create($validated);

        // Redirect
        return redirect()->route('admin.tables.index')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    public function edit(Table $table): View
    {
        return view('admin.tables.edit', ['table' => $table]);
    }

    public function update(Request $request, Table $table): RedirectResponse
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name,' . $table->id,
        ], [
            'name.unique' => 'Nama meja ini sudah ada.'
        ]);
        
        // Update
        $table->update($validated);

        // Redirect
        return redirect()->route('admin.tables.index')->with('success', 'Nama meja berhasil diperbarui!');
    }
    public function destroy(Table $table): RedirectResponse
    {
        // Hapus meja
        $table->delete();

        // Redirect
        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil dihapus!');
    }
}