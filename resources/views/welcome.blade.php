<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Upperside - Retro Space</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="bg-gray-100 text-brand-black font-body selection:bg-brand-purple selection:text-white">

    <nav class="fixed w-full z-50 bg-white border-b-4 border-black">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center">
            <a href="#" class="font-display text-2xl tracking-tighter uppercase flex items-center gap-2">
                The Upper<span class="bg-brand-yellow px-2 border-2 border-black transform -skew-x-12">Side</span>
            </a>

            <div class="hidden md:flex items-center gap-8 font-bold uppercase tracking-wide text-sm">
                <a href="#about" class="hover:bg-brand-yellow hover:px-2 transition-all duration-300 border-2 border-transparent hover:border-black">Story</a>
                <a href="#menu" class="hover:bg-brand-yellow hover:px-2 transition-all duration-300 border-2 border-transparent hover:border-black">Menu</a>
                <a href="#moments" class="hover:bg-brand-yellow hover:px-2 transition-all duration-300 border-2 border-transparent hover:border-black">Moments</a>
                <a href="#location" class="hover:bg-brand-yellow hover:px-2 transition-all duration-300 border-2 border-transparent hover:border-black">Visit</a>
            </div>

            <a href="{{ route('order.start') }}" class="hidden md:block px-6 py-2 bg-brand-purple text-white font-bold border-2 border-black shadow-retro hover:shadow-retro-hover hover:-translate-y-1 transition-all duration-300">
                Book Table
            </a>
        </div>
    </nav>

    <header class="relative pt-32 pb-20 overflow-hidden border-b-4 border-black bg-brand-yellow">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 20px 20px;"></div>

        <div class="container mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <div class="inline-block bg-white border-2 border-black px-4 py-1 font-bold mb-6 shadow-retro-sm rotate-2">
                    EST. 2025 • CIMAHI ROOFTOP
                </div>
                <h1 class="font-display text-6xl md:text-8xl leading-none mb-6 uppercase">
                    Level Up<br>
                    <span class="text-white text-stroke-black">Your Coffee</span>
                </h1>
                <p class="text-xl font-medium mb-10 max-w-lg leading-relaxed border-l-4 border-black pl-6">
                    Rasakan sensasi ngopi di ketinggian dengan gaya yang berbeda. Bukan sekadar tempat nongkrong, ini adalah <span class="bg-brand-purple text-white px-1">kultur baru.</span>
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('order.start') }}" class="px-8 py-4 bg-black text-white font-bold border-2 border-black shadow-retro hover:bg-white hover:text-black transition-all">
                        EXPLORE MENU
                    </a>
                    <a href="#location" class="px-8 py-4 bg-transparent font-bold border-2 border-black hover:bg-black hover:text-white transition-all">
                        FIND US
                    </a>
                </div>
            </div>

            <div class="md:w-1/2 relative">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-purple rounded-full border-4 border-black z-0"></div>
                <div class="absolute -bottom-10 -left-10 w-full h-12 bg-white border-4 border-black z-0"></div>
                
                <div class="relative z-10 border-4 border-black shadow-retro bg-white p-2 rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img src="{{ asset('images/hero-bg.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=800&auto=format&fit=crop'" alt="Coffee Vibes" class="w-full h-[400px] object-cover border-2 border-black grayscale hover:grayscale-0 transition-all duration-500">
                </div>
            </div>
        </div>
    </header>

    <div class="bg-brand-black text-brand-yellow border-b-4 border-black py-4 overflow-hidden relative">
        <div class="flex animate-marquee">
            <div class="font-display text-2xl uppercase tracking-widest whitespace-nowrap px-4">
                COFFEE • COMMUNITY • CREATIVITY • GOOD VIBES ONLY • OPEN DAILY 15:00 - 23:00 • THE UPPERSIDE • 
            </div>
            <div class="font-display text-2xl uppercase tracking-widest whitespace-nowrap px-4">
                COFFEE • COMMUNITY • CREATIVITY • GOOD VIBES ONLY • OPEN DAILY 15:00 - 23:00 • THE UPPERSIDE • 
            </div>
            <div class="font-display text-2xl uppercase tracking-widest whitespace-nowrap px-4">
                COFFEE • COMMUNITY • CREATIVITY • GOOD VIBES ONLY • OPEN DAILY 15:00 - 23:00 • THE UPPERSIDE • 
            </div>
        </div>
    </div>

    <section id="menu" class="py-24 bg-gray-100 border-t-4 border-black">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <h3 class="font-display text-5xl uppercase">Top <span class="text-stroke-black text-transparent" style="-webkit-text-stroke: 2px black;">Picks</span></h3>
                <div class="hidden md:block w-32 h-4 bg-brand-black"></div>
            </div>

            @if(isset($topSellingProducts) && $topSellingProducts->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($topSellingProducts as $item)
                    <div class="group relative bg-white border-4 border-black p-4 shadow-retro hover:shadow-retro-hover hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
                        
                        <div class="relative h-64 w-full border-2 border-black mb-4 overflow-hidden bg-gray-200">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500 grayscale group-hover:grayscale-0"
                                     alt="{{ $item->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=600&q=80" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500 grayscale group-hover:grayscale-0">
                            @endif
                            
                            <div class="absolute top-0 right-0 bg-brand-yellow border-l-2 border-b-2 border-black px-3 py-1 font-bold font-display text-lg">
                                #{{ $loop->iteration }}
                            </div>
                        </div>

                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-display text-2xl uppercase leading-none">{{ $item->name }}</h4>
                        </div>
                        <p class="text-sm font-medium mb-4 min-h-[40px] flex-grow">{{ $item->description ?? 'Rasa yang tak terlupakan.' }}</p>
                        
                        <div class="flex justify-between items-center border-t-2 border-black pt-4 mt-auto">
                            <span class="font-display text-xl">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            @if($item->total_sold > 0)
                                <span class="bg-brand-purple text-white px-2 py-1 text-xs font-bold border border-black">
                                    SOLD {{ $item->total_sold }}
                                </span>
                            @else
                                <span class="bg-black text-white px-2 py-1 text-xs font-bold border border-black">
                                    RECOMMENDED
                                </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @for($i=1; $i<=3; $i++)
                    <div class="bg-white border-4 border-black p-4 shadow-retro">
                        <div class="h-64 bg-gray-200 border-2 border-black mb-4 flex items-center justify-center">
                            <span class="font-display text-gray-400 text-4xl">?</span>
                        </div>
                        <h4 class="font-display text-2xl uppercase">Menu Coming Soon</h4>
                    </div>
                    @endfor
                </div>
            @endif

            <div class="text-center mt-12">
                 <a href="{{ route('order.start') }}" class="inline-block px-10 py-4 bg-brand-yellow text-black font-display uppercase tracking-widest border-4 border-black shadow-retro hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                    View Full Menu ->
                </a>
            </div>
        </div>
    </section>

    <section id="moments" class="py-24 bg-brand-purple border-t-4 border-black overflow-hidden relative">
        <div class="absolute top-10 left-10 w-20 h-20 bg-brand-yellow border-4 border-black rounded-full opacity-50"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-white border-4 border-black opacity-20 transform rotate-12"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h3 class="font-display text-5xl md:text-6xl uppercase text-white mb-4">Captured <span class="text-brand-yellow text-stroke-black" style="-webkit-text-stroke: 2px black;">Moments</span></h3>
                <p class="text-white font-bold tracking-widest border-2 border-black bg-black inline-block px-4 py-1 transform -rotate-2">
                    #THEUPPERSIDE
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                
                <div class="bg-white p-4 pb-12 border-4 border-black shadow-retro transform rotate-n2 hover:rotate-0 hover:scale-105 transition-all duration-300">
                    <div class="border-2 border-black overflow-hidden h-64 mb-4 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                    </div>
                    <p class="font-handwriting text-center font-bold text-xl uppercase tracking-widest text-gray-800">
                        Friday Night Live
                    </p>
                </div>

                <div class="bg-white p-4 pb-12 border-4 border-black shadow-retro transform rotate-1 hover:rotate-0 hover:scale-105 transition-all duration-300 md:-mt-8">
                    <div class="border-2 border-black overflow-hidden h-64 mb-4 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                    </div>
                    <p class="font-handwriting text-center font-bold text-xl uppercase tracking-widest text-gray-800">
                        Community Brew
                    </p>
                </div>

                <div class="bg-white p-4 pb-12 border-4 border-black shadow-retro transform rotate-n1 hover:rotate-0 hover:scale-105 transition-all duration-300">
                    <div class="border-2 border-black overflow-hidden h-64 mb-4 bg-gray-200">
                        <img src="https://images.unsplash.com/photo-1542181961-9590d0c79dab?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                    </div>
                    <p class="font-handwriting text-center font-bold text-xl uppercase tracking-widest text-gray-800">
                        Sunset View
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="location" class="py-0 flex flex-col md:flex-row border-t-4 border-black">
        <div class="md:w-1/2 bg-brand-yellow text-black p-12 md:p-20 flex flex-col justify-center border-b-4 md:border-b-0 md:border-r-4 border-black">
            <h3 class="font-display text-5xl mb-8 uppercase">Drop By</h3>
            
            <div class="space-y-8 font-bold text-lg">
                <div class="flex gap-4 items-start">
                    <div class="bg-white text-black p-2 border-2 border-black shadow-retro-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <p>Rooftop Cimahi Mall,<br>Setiamanah, Jawa Barat</p>
                </div>

                <div class="flex gap-4 items-start">
                    <div class="bg-white text-black p-2 border-2 border-black shadow-retro-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p>Open Daily<br>15:00 - 23:00</p>
                </div>
            </div>
            
            <a href="https://goo.gl/maps" class="mt-12 inline-block text-center w-full py-4 bg-black text-white font-display uppercase tracking-widest border-2 border-white hover:bg-white hover:text-black transition-colors">
                Get Directions
            </a>
        </div>

        <div class="md:w-1/2 min-h-[500px] relative bg-gray-200">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d126755.225039052!2d107.3872386!3d-6.878528!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e5bf98c27365%3A0x36335362113170c8!2sThe%20Upperside!5e0!3m2!1sid!2sid!4v1763217423507!5m2!1sid!2sid" 
                width="100%" 
                height="100%" 
                style="border:0; filter: grayscale(100%) contrast(1.2);" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-brand-yellow border-2 border-black px-4 py-2 font-display uppercase shadow-retro text-xl">
                We Are Here
            </div>
        </div>
    </section>

    <footer id="contact" class="bg-brand-black text-white pt-20 pb-10 border-t-4 border-black">
        <div class="container mx-auto px-6 text-center">
            <h2 class="font-display text-4xl md:text-7xl mb-8 uppercase text-brand-yellow">
                Don't Be Shy
            </h2>
            <p class="text-xl mb-12 max-w-2xl mx-auto font-light">
                Booking tempat untuk acara, pemotretan, atau sekadar nongkrong bareng geng? Hubungi kami langsung.
            </p>

            <div class="flex justify-center gap-6 mb-20">
                <a href="https://wa.me/6281234567890" class="px-8 py-4 bg-brand-yellow text-black font-bold border-2 border-white shadow-[4px_4px_0px_0px_rgba(255,255,255,1)] hover:translate-y-1 hover:shadow-none transition-all">
                    WHATSAPP US
                </a>
            </div>

            <div class="border-t border-gray-800 pt-10 flex flex-col md:flex-row justify-between items-center gap-4 text-sm font-bold uppercase tracking-widest text-gray-500">
                <p>© 2025 THE UPPERSIDE TM.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-brand-yellow transition">Instagram</a>
                    <a href="#" class="hover:text-brand-yellow transition">TikTok</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>