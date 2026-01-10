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
        <div class="flex items-center gap-4 border-b-4 border-black pb-4">
            <a href="{{ route('admin.tables.index') }}" class="p-2 border-2 border-black bg-white hover:bg-black hover:text-white transition shadow-retro-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black">
                {{ __('Tambah Meja') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white border-4 border-black p-8 shadow-retro relative">
                
                <div class="absolute -top-3 -right-3 bg-brand-purple text-white border-2 border-black px-3 py-1 font-bold text-xs uppercase shadow-sm rotate-3">
                    New Seat
                </div>

                <form method="POST" action="{{ route('admin.tables.store') }}">
                    @csrf 

                    <div class="mb-8 text-center">
                        <div class="inline-block p-3 bg-brand-yellow border-2 border-black rounded-full mb-4">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 100-4 2 2 0 000 4zm-6-2a2 2 0 100-4 2 2 0 000 4zm6-2a2 2 0 100-4 2 2 0 000 4zm-6-2a2 2 0 100-4 2 2 0 000 4z"/></svg>
                        </div>
                        <h3 class="font-bold text-xl uppercase">Registrasi Meja</h3>
                        <p class="text-sm text-gray-500 mt-1">Masukkan nama atau nomor meja baru.</p>
                    </div>

                    <div class="mb-6">
                        <label for="name" class="block font-bold text-sm uppercase mb-2">Nama / Nomor Meja</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" 
                               class="block w-full p-4 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-display text-xl uppercase tracking-wider" 
                               required autofocus placeholder="CONTOH: MEJA 05">
                        
                        @error('name')
                            <p class="text-red-600 text-xs font-bold mt-2 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t-2 border-dashed border-gray-300">
                        <a href="{{ route('admin.tables.index') }}" class="px-6 py-3 border-2 border-transparent text-gray-500 font-bold uppercase hover:text-black transition">
                            &larr; Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-black text-brand-yellow font-bold uppercase tracking-wider border-2 border-transparent hover:bg-brand-yellow hover:text-black hover:border-black hover:shadow-retro-sm transition-all active:translate-y-1 active:shadow-none shadow-md">
                            Simpan Meja
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>