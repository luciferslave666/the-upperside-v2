<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;



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
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name',
        ], [
            'name.unique' => 'Nama meja ini sudah ada.'
        ]);

        $qrCode = 'TABLE-' . uniqid();
        $validated['qr_code'] = $qrCode;

        Table::create($validated);

        return redirect()->route('admin.tables.index')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    public function edit(Table $table): View
    {
        return view('admin.tables.edit', ['table' => $table]);
    }

    public function update(Request $request, Table $table): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name,' . $table->id,
        ], [
            'name.unique' => 'Nama meja ini sudah ada.'
        ]);
        
        $table->update($validated);

        return redirect()->route('admin.tables.index')->with('success', 'Nama meja berhasil diperbarui!');
    }

    public function destroy(Table $table): RedirectResponse
    {
        $table->delete();

        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil dihapus!');
    }

    private function generateQrCode(string $data): string
    {
        try {
            $qrCode = new QrCode(
                data: $data,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 10,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
            );

            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            return 'data:image/png;base64,' . base64_encode($result->getString());
        } catch (\Exception $e) {
            throw new \Exception('Gagal generate QR Code: ' . $e->getMessage());
        }
    }

    public function showQrCode(Table $table): View
    {
        try {
            $qrCodeUrl = route('order.by.qr', ['qrCode' => $table->qr_code]);
            $qrCodeBase64 = $this->generateQrCode($qrCodeUrl);

            return view('admin.tables.qr-preview', [
                'table' => $table,
                'qrCode' => $qrCodeBase64
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal generate QR Code: ' . $e->getMessage());
        }
    }

    public function downloadQrCode(Table $table)
    {
        try {
            $qrCodeUrl = route('order.by.qr', ['qrCode' => $table->qr_code]);
            
            $qrCode = new QrCode(
                data: $qrCodeUrl,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 10,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
            );

            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            return response($result->getString(), 200, [
                'Content-Type' => 'image/png',
                'Content-Disposition' => 'attachment; filename="QR-Code-' . $table->name . '.png"'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal download QR Code: ' . $e->getMessage());
        }
    }

    public function regenerateQrCode(Table $table): RedirectResponse
    {
        try {
            $qrCode = 'TABLE-' . uniqid();
            $table->update(['qr_code' => $qrCode]);

            return redirect()->back()->with('success', 'QR Code berhasil di-generate ulang!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal generate ulang QR Code: ' . $e->getMessage());
        }
    }
    
}