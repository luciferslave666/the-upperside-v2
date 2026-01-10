<x-app-layout>
    @push('styles')
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'brand-yellow': '#DFFF4F',
                            'brand-purple': '#8A85D6',
                            'brand-black': '#111111',
                        },
                        fontFamily: {
                            'display': ['"Archivo Black"', 'sans-serif'],
                            'body': ['"Space Grotesk"', 'sans-serif'],
                        },
                        boxShadow: {
                            'retro': '6px 6px 0px 0px rgba(0,0,0,1)',
                            'retro-sm': '3px 3px 0px 0px rgba(0,0,0,1)',
                            'retro-input': '4px 4px 0px 0px rgba(0,0,0,1)',
                        }
                    }
                }
            }
        </script>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Space Grotesk', sans-serif; }</style>
    @endpush

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center gap-4 border-b-4 border-black pb-4">
            <a href="{{ route('admin.tables.index') }}" class="p-2 border-2 border-black bg-white hover:bg-black hover:text-white transition shadow-retro-sm w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black leading-none">
                    Edit Meja
                </h2>
                <span class="inline-block mt-1 bg-brand-yellow text-black px-2 py-0.5 text-xs font-bold uppercase border border-black transform -rotate-1 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    Target: {{ $table->name }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white border-4 border-black p-8 shadow-retro relative">
                
                <div class="absolute -top-3 -right-3 bg-brand-black text-white border-2 border-white px-3 py-1 font-bold text-xs uppercase shadow-retro-sm rotate-2">
                    Editing Mode
                </div>

                <form method="POST" action="{{ route('admin.tables.update', $table) }}">
                    @csrf 
                    @method('PATCH')

                    <div class="mb-8 text-center">
                        <div class="inline-block p-3 bg-white border-2 border-black rounded-full mb-4 shadow-retro-sm">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <h3 class="font-bold text-xl uppercase">Perbarui Data</h3>
                        <p class="text-sm text-gray-500 mt-1">Ubah nama atau nomor meja di bawah ini.</p>
                    </div>

                    <div class="mb-6">
                        <label for="name" class="block font-bold text-sm uppercase mb-2">Nama / Nomor Meja</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $table->name) }}" 
                               class="block w-full p-4 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-display text-xl uppercase tracking-wider" 
                               required autofocus>
                        
                        @error('name')
                            <p class="text-red-600 text-xs font-bold mt-2 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t-2 border-dashed border-gray-300">
                        <a href="{{ route('admin.tables.index') }}" class="px-6 py-3 border-2 border-transparent text-gray-500 font-bold uppercase hover:text-black transition">
                            &larr; Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-brand-purple text-white font-bold uppercase tracking-wider border-2 border-black hover:bg-white hover:text-brand-purple hover:shadow-retro-sm transition-all active:translate-y-1 active:shadow-none shadow-md">
                            Update Meja
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>