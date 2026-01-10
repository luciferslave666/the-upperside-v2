<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - The Upperside</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-brand-yellow min-h-screen flex flex-col items-center justify-center p-4 relative overflow-hidden font-body text-brand-black">

    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 20px 20px;"></div>

    <div class="absolute top-10 left-10 w-16 h-16 bg-brand-purple border-4 border-black hidden md:block animate-bounce"></div>
    <div class="absolute bottom-10 right-10 w-24 h-24 bg-white border-4 border-black rounded-full hidden md:block"></div>

    <div class="max-w-md w-full relative z-10">
        
        <div class="text-center mb-8 transform -rotate-1">
            <h1 class="font-display text-5xl uppercase tracking-tighter mb-2">
                The Upper<span class="bg-brand-purple text-white px-2 border-2 border-black inline-block transform skew-x-[-10deg]">Side</span>
            </h1>
            <div class="inline-block bg-white border-2 border-black px-4 py-1 font-bold text-sm shadow-retro-sm">
                SELAMAT DATANG!
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-retro p-8 relative">
            <div class="absolute -top-2 -left-2 w-full h-full border-2 border-black bg-transparent pointer-events-none z-0 translate-x-1 translate-y-1"></div>

            <form class="space-y-6 relative z-10" action="{{ route('order.start.submit') }}" method="POST">
                @csrf
                
                <div>
                    <label for="customer_name" class="block font-display uppercase text-lg mb-2">
                        Nama Kamu
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input id="customer_name" 
                               name="customer_name" 
                               type="text" 
                               required
                               placeholder="Tulis nama disini..."
                               class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-black focus:bg-brand-yellow focus:ring-0 focus:outline-none placeholder-gray-500 font-bold transition-colors">
                    </div>
                </div>

                <div>
                    <label for="number_of_people" class="block font-display uppercase text-lg mb-2">
                        Jumlah Orang
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <input id="number_of_people" 
                               name="number_of_people" 
                               type="number" 
                               min="1" 
                               value="1" 
                               required
                               class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-black focus:bg-brand-yellow focus:ring-0 focus:outline-none font-bold transition-colors">
                    </div>
                </div>

                <div>
                    <label for="table_id" class="block font-display uppercase text-lg mb-2">
                        Pilih Meja
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </div>
                        <select id="table_id" 
                                name="table_id" 
                                required
                                class="block w-full pl-12 pr-10 py-4 bg-gray-50 border-2 border-black focus:bg-brand-yellow focus:ring-0 focus:outline-none font-bold appearance-none cursor-pointer transition-colors">
                            
                            <option value="" disabled selected>Pilih Nomor Meja</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}">{{ $table->name }}</option>
                            @endforeach
                        </select>
                        
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none border-l-2 border-black bg-gray-100">
                            <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full flex justify-center items-center gap-3 py-4 bg-brand-black text-brand-yellow font-display uppercase tracking-widest text-lg border-2 border-black shadow-retro-sm hover:translate-y-1 hover:shadow-none hover:bg-white hover:text-black transition-all duration-200">
                        <span>Mulai Pesan</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-3 gap-3 mt-8 pt-6 border-t-2 border-black">
                <div class="text-center p-2 bg-brand-yellow border-2 border-black shadow-retro-sm transform -rotate-2">
                    <div class="text-2xl">☕</div>
                    <p class="text-xs font-bold uppercase mt-1">Fresh Brew</p>
                </div>
                <div class="text-center p-2 bg-brand-purple text-white border-2 border-black shadow-retro-sm transform rotate-1">
                    <div class="text-2xl">🍕</div>
                    <p class="text-xs font-bold uppercase mt-1">Good Food</p>
                </div>
                <div class="text-center p-2 bg-white border-2 border-black shadow-retro-sm transform -rotate-1">
                    <div class="text-2xl">⚡</div>
                    <p class="text-xs font-bold uppercase mt-1">Fast Serve</p>
                </div>
            </div>
        </div>

        <p class="text-center mt-8 font-bold text-sm tracking-wide opacity-70">
            © 2025 THE UPPERSIDE • DIGITAL MENU
        </p>

    </div>

</body>
</html>