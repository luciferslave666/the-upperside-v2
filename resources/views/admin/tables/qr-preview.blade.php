<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            QR Code - {{ $table->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Card QR Code -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">{{ $table->name }}</h3>
                        <p class="text-gray-600 mb-4">Scan QR code di bawah untuk memulai order</p>
                        
                        <!-- QR Code Image -->
                        <div class="flex justify-center bg-gray-100 p-8 border-2 border-gray-300 rounded-lg mb-6">
                            <img src="{{ $qrCode }}" alt="QR Code {{ $table->name }}" style="max-width: 300px;">
                        </div>

                        <!-- QR Code Code -->
                        <div class="bg-gray-50 p-4 rounded border border-gray-200 mb-6">
                            <p class="text-xs text-gray-600 mb-1">Kode QR:</p>
                            <p class="font-mono text-sm font-bold break-all">{{ $table->qr_code }}</p>
                        </div>

                        <!-- Scan URL -->
                        <div class="bg-blue-50 p-4 rounded border border-blue-200 mb-6">
                            <p class="text-xs text-blue-600 mb-1">URL Scan:</p>
                            <p class="font-mono text-xs break-all text-blue-900">
                                {{ route('order.by.qr', ['qrCode' => $table->qr_code]) }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 justify-center flex-wrap">
                        <!-- Download Button -->
                        <a href="{{ route('admin.tables.qr-download', $table) }}" 
                           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition font-semibold">
                            ⬇️ Download QR Code
                        </a>

                        <!-- Print Button -->
                        <button onclick="window.print()" 
                                class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition font-semibold">
                            🖨️ Cetak QR Code
                        </button>

                        <!-- Regenerate Button -->
                        <form action="{{ route('admin.tables.regenerateQr', $table) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin generate ulang QR Code?');">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition font-semibold">
                                🔄 Generate Ulang
                            </button>
                        </form>

                        <!-- Back Button -->
                        <a href="{{ route('admin.tables.index') }}" 
                           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition font-semibold">
                            ← Kembali
                        </a>
                    </div>

                    <!-- Info -->
                    <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded text-sm text-blue-800">
                        <p class="font-bold mb-2">💡 Cara Menggunakan:</p>
                        <ol class="list-decimal list-inside space-y-1">
                            <li>Download atau cetak QR Code ini</li>
                            <li>Tempel di meja restoran Anda</li>
                            <li>Pelanggan scan dengan kamera smartphone mereka</li>
                            <li>Akan langsung membuka halaman order dengan nomor meja terisi otomatis</li>
                        </ol>
                    </div>

                    <!-- Print Styles -->
                    <style>
                        @media print {
                            .no-print {
                                display: none;
                            }
                            body {
                                margin: 0;
                                padding: 0;
                            }
                            .bg-white {
                                box-shadow: none;
                            }
                        }
                    </style>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>