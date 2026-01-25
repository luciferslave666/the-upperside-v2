<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Menu - The Upperside</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-brand-black pb-20">
    <header class="bg-brand-yellow border-b-4 border-black sticky top-0 z-40">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="/" class="font-display text-2xl tracking-tighter uppercase flex items-center gap-2">
                The Upper<span class="bg-brand-purple px-2 border-2 border-black transform -skew-x-12 text-white">Side</span>
            </a>
            <a href="/" class="px-6 py-2 bg-brand-purple text-white font-bold border-2 border-black shadow-retro hover:shadow-retro-hover hover:-translate-y-1 transition-all duration-300">
                Kembali
            </a>
        </div>
    </header>

    <main class="container mx-auto max-w-3xl px-4 pt-10">
        <h1 class="font-display text-4xl uppercase mb-8 text-center border-b-4 border-brand-purple inline-block px-8 py-2 bg-white shadow-retro-sm">Full Menu</h1>
        @foreach ($categories as $category)
            <section class="mb-12">
                <h2 class="font-display text-2xl uppercase mb-4 border-b-4 border-brand-yellow inline-block">{{ $category->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($category->products as $product)
                        <div class="bg-white border-2 border-black p-4 flex gap-4 shadow-retro-sm">
                            <div class="w-24 h-24 bg-gray-200 border-2 border-black flex-shrink-0">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/200x200.png?text=Menu' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold uppercase leading-tight text-lg">{{ $product->name }}</h3>
                                    <p class="text-xs text-gray-500 mb-2">{{ $product->description }}</p>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="font-display text-xl text-brand-purple">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @if($product->estimated_time)
                                        <span class="text-xs bg-brand-yellow border border-black px-2 py-0.5 font-bold rounded">{{ $product->estimated_time }} menit</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-400 font-bold border-2 border-dashed border-gray-300 py-6 text-center col-span-2">Belum ada produk</div>
                    @endforelse
                </div>
            </section>
        @endforeach
    </main>
</body>
</html>
