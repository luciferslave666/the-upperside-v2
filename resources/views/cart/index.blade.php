<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Anda</title>
    
    <script type="text/javascript"
            src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
        }
        .cart-item {
            transition: all 0.2s ease;
        }
        .cart-item:hover {
            background-color: #f9fafb;
        }
        /* 2. STYLE UNTUK LOADING SPINNER */
        .spinner {
            border: 4px solid rgba(255, 255, 255, .3);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border-left-color: #fff;
            animation: spin 1s ease infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        </header>

    @if (session('success'))
        @endif
    @if (session('error'))
        @endif

    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden mb-6">
                
                @if($cartItems->isEmpty())
                    @else
                    <div class="divide-y divide-gray-200">
                        @foreach ($cartItems as $item)
                            @endforeach
                        
                        <div class="p-6 bg-gray-50 space-y-3">
                            <h4 class="text-lg font-semibold text-gray-900">Rincian Tagihan</h4>
                            
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal ({{ $cartItems->count() }} Item)</span>
                                <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
    
                            <div class="flex justify-between text-gray-700">
                                <span>Biaya Layanan ({{ $service_percent }}%)</span>
                                <span class="font-medium">Rp {{ number_format($service_fee_amount, 0, ',', '.') }}</span>
                            </div>
    
                            <div class="flex justify-between text-gray-700">
                                <span>Pajak ({{ $tax_percent }}%)</span>
                                <span class="font-medium">Rp {{ number_format($tax_amount, 0, ',', '.') }}</span>
                            </div>
    
                            <div class="border-t border-gray-200 !mt-4 !mb-2"></div>
    
                            <div class="flex justify-between items-center text-gray-900">
                                <span class="text-xl font-bold">Total Pembayaran</span>
                                <span class="text-2xl font-extrabold text-indigo-600">
                                    Rp {{ number_format($grand_total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if(!$cartItems->isEmpty())
                <div class="bg-white shadow-sm border border-gray-200 rounded-lg p-8">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pilih Metode Pembayaran</h3>
                        <p class="text-gray-600">Pilih cara pembayaran yang paling nyaman untuk Anda</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <form action="{{ route('order.place.counter') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full group">
                                <div class="border-2 border-gray-300 hover:border-gray-900 p-6 rounded-lg transition-all">
                                    <div class="flex flex-col items-center space-y-3 text-center">
                                        <div class="p-3 bg-gray-100 group-hover:bg-gray-900 rounded-lg transition">
                                            <svg class="w-8 h-8 text-gray-900 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900 mb-1">Bayar di Kasir</h4>
                                            <p class="text-sm text-gray-600">Bayar langsung di kasir saat mengambil pesanan</p>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </form>
                        
                        <button id="pay-online-button" class="w-full group">
                            <div class="border-2 border-indigo-600 bg-indigo-50 p-6 rounded-lg transition-all hover:bg-indigo-100">
                                <div class="flex flex-col items-center space-y-3 text-center">
                                    <div class="p-3 bg-indigo-100 group-hover:bg-indigo-200 rounded-lg transition">
                                        <svg class="w-8 h-8 text-indigo-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-indigo-700 mb-1">Bayar Sekarang</h4>
                                        <p class="text-sm text-indigo-600 mb-2">Bayar online menggunakan QRIS atau e-wallet</p>
                                        <div class="flex justify-center gap-2">
                                            <span class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-medium rounded">QRIS</span>
                                            <span class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-medium rounded">GoPay</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </main>

    <footer class="mt-12 pb-8 text-center text-gray-600">
        </footer>

    
    @if(!$cartItems->isEmpty())
    <script type="text/javascript">
        // Siapkan URL untuk redirect sukses (kita butuh :id sebagai placeholder)
        // Ini akan mengambil route 'order.success' dari Laravel
        let successUrl = "{{ route('order.success', ['order' => ':id']) }}";

        // Ambil tombol
        var payButton = document.getElementById('pay-online-button');
        var payButtonHtml = payButton.innerHTML; // Simpan HTML asli tombol

        // Tambahkan event listener
        payButton.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah aksi default

            // Tampilkan loading spinner
            payButton.disabled = true;
            // Ganti HTML tombol dengan spinner
            payButton.innerHTML = `<div class="p-6 h-full flex items-center justify-center"><div class="spinner" style="border-left-color: #4f46e5;"></div></div>`;

            // Kirim request ke backend (OrderController@placeOrderOnline)
            fetch('{{ route("order.place.online") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ambil token CSRF
                },
                // Body bisa kosong karena controller ambil data dari session
            })
            .then(response => response.json())
            .then(data => {
                // 'data' adalah JSON yang dikirim dari 'placeOrderOnline'
                if (data.error) {
                    // Jika ada error dari controller (misal: session habis)
                    alert(data.error);
                    // Kembalikan tombol ke state semula
                    payButton.disabled = false;
                    payButton.innerHTML = payButtonHtml;
                } else {
                    // Jika sukses dapat token, buka pop-up Snap
                    window.snap.pay(data.snapToken, {
                        onSuccess: function(result){
                            /* Pembayaran sukses! 
                                Webhook akan menangani update status database.
                                Kita HANYA perlu redirect ke halaman sukses.
                            */
                            // Ganti :id di URL dengan orderId yang kita dapat
                            window.location.href = successUrl.replace(':id', data.orderId);
                        },
                        onPending: function(result){
                            /* Pelanggan belum bayar */
                            alert("Menunggu pembayaran Anda...");
                            // Kembalikan tombol
                            payButton.disabled = false;
                            payButton.innerHTML = payButtonHtml;
                        },
                        onError: function(result){
                            /* Pembayaran gagal */
                            alert("Pembayaran gagal!");
                            // Kembalikan tombol
                            payButton.disabled = false;
                            payButton.innerHTML = payButtonHtml;
                        },
                        onClose: function(){
                            /* Pelanggan menutup pop-up sebelum bayar.
                                Pesanan sudah dibuat di database (status: pending).
                                Kita biarkan saja, pelanggan bisa coba bayar lagi
                                atau pesanan akan otomatis kadaluarsa (jika di-setting di Midtrans).
                                Kita kembalikan tombolnya.
                            */
                            alert('Anda menutup pop-up pembayaran. Silakan coba lagi.');
                            // Kembalikan tombol
                            payButton.disabled = false;
                            payButton.innerHTML = payButtonHtml;
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
                // Kembalikan tombol
                payButton.disabled = false;
                payButton.innerHTML = payButtonHtml;
            });
        });
    </script>
    @endif
    
</body>
</html>