<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Data Pesanan - The Upperside</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">

    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="font-display text-3xl uppercase mb-2">Selamat Datang!</h1>
            <p class="text-gray-600">Meja: <strong>{{ $table->name }}</strong></p>
        </div>

        <form action="{{ route('order.byQr.submit') }}" method="POST" class="bg-white border-2 border-black p-6 shadow-retro-sm">
            @csrf
            
            <div class="mb-4">
                <label class="font-bold text-sm uppercase text-gray-700 block mb-2">Nama Anda</label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                    class="w-full px-3 py-2 border-2 border-black focus:outline-none focus:ring-2 focus:ring-brand-purple">
                @error('customer_name')
                    <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="font-bold text-sm uppercase text-gray-700 block mb-2">Jumlah Orang</label>
                <input type="number" name="number_of_people" value="{{ old('number_of_people') }}" min="1" required
                    class="w-full px-3 py-2 border-2 border-black focus:outline-none focus:ring-2 focus:ring-brand-purple">
                @error('number_of_people')
                    <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-brand-black text-brand-yellow font-display uppercase font-bold border-2 border-black shadow-retro-sm hover:translate-y-1 hover:shadow-none transition-all">
                Lanjut ke Menu →
            </button>
        </form>
    </div>

</body>
</html>