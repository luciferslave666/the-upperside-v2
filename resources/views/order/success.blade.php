<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Diterima! - The Upperside</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4 relative overflow-hidden text-brand-black">

    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 20px 20px;"></div>

    <div class="absolute top-10 left-10 w-20 h-20 bg-brand-yellow border-4 border-black rounded-full hidden md:block"></div>
    <div class="absolute bottom-10 right-10 w-16 h-16 bg-brand-purple border-4 border-black rotate-12 hidden md:block"></div>

    <div class="max-w-xl w-full relative z-10">
        
        <div class="bg-white border-4 border-black shadow-retro p-8 sm:p-10 relative text-center">
            
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-brand-yellow border-4 border-black flex items-center justify-center shadow-retro-sm">
                    <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <h1 class="font-display text-4xl sm:text-5xl uppercase leading-none mb-2">
                Order <br>
                <span class="text-brand-purple">Received!</span>
            </h1>
            <p class="font-bold text-gray-500 mb-8">Terima kasih, pesananmu sudah masuk.</p>

            <div class="ticket-animate bg-brand-black text-white p-6 border-4 border-black mb-10 shadow-[8px_8px_0px_0px_#DFFF4F] relative mx-auto max-w-sm">
                <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-white rounded-full border-2 border-black"></div>
                <div class="absolute -right-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-white rounded-full border-2 border-black"></div>

                <p class="font-display text-sm uppercase tracking-widest text-brand-yellow mb-2">NOMOR PESANAN</p>
                <div class="font-display text-6xl tracking-widest leading-none">
                    #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </div>
                <p class="text-xs font-bold text-gray-400 mt-2 uppercase">Simpan & Tunjukkan ke Kasir</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 text-left">
                
                <div class="bg-white border-2 border-black p-4 shadow-retro-sm">
                    <div class="flex items-center gap-3 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span class="font-bold text-xs uppercase text-gray-500">Total Tagihan</span>
                    </div>
                    <p class="font-display text-xl">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-white border-2 border-black p-4 shadow-retro-sm">
                    <div class="flex items-center gap-3 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-bold text-xs uppercase text-gray-500">Status</span>
                    </div>
                    <div class="inline-block bg-yellow-300 border border-black px-2 py-0.5 text-xs font-bold uppercase mt-1">
                        Menunggu Konfirmasi
                    </div>
                </div>
            </div>

            <div class="bg-brand-purple border-2 border-black p-6 text-white text-left relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-20">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                </div>
                
                <h4 class="font-display text-lg uppercase mb-4 flex items-center gap-2">
                    <span class="bg-brand-yellow text-black w-6 h-6 flex items-center justify-center text-sm border border-black">!</span> 
                    Langkah Selanjutnya
                </h4>
                
                <ul class="space-y-3 font-medium text-sm">
                    <li class="flex items-start gap-3">
                        <span class="font-display text-brand-yellow text-lg leading-none">1.</span>
                        <span>Pergi ke kasir & tunjukkan <strong class="text-brand-yellow underline">Nomor Pesanan</strong> di atas.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="font-display text-brand-yellow text-lg leading-none">2.</span>
                        <span>Lakukan pembayaran sesuai total tagihan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="font-display text-brand-yellow text-lg leading-none">3.</span>
                        <span>Duduk manis, pesanan akan diantar ke meja Anda!</span>
                    </li>
                </ul>
            </div>

            <div class="mt-8 pt-6 border-t-2 border-dashed border-gray-300">
                <p class="font-display text-lg uppercase">Selamat Menikmati!</p>
                <p class="text-xs font-bold text-gray-400 mt-1 uppercase">The Upperside Crew</p>
                
                <div class="mt-6">
                    <a href="/" class="inline-block px-6 py-3 bg-white border-2 border-black font-bold uppercase hover:bg-black hover:text-white transition-colors">
                        Kembali ke Menu
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>