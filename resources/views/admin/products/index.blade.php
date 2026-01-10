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
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b-4 border-black pb-4">
            <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black">
                {{ __('Manajemen Menu') }}
            </h2>

            <div class="flex space-x-4">
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'settings-modal')" 
                        class="px-4 py-2 bg-white border-2 border-black text-black font-bold uppercase hover:bg-black hover:text-white transition shadow-retro-sm active:shadow-none active:translate-x-1 active:translate-y-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Setting Biaya</span>
                </button>

                <a href="{{ route('admin.products.create') }}" 
                   class="px-4 py-2 bg-brand-purple text-white border-2 border-black font-bold uppercase hover:bg-white hover:text-brand-purple transition shadow-retro-sm active:shadow-none active:translate-x-1 active:translate-y-1">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-brand-yellow border-2 border-black shadow-retro-sm flex items-center gap-3">
                    <div class="bg-black text-white p-1 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    <span class="font-bold uppercase tracking-wide">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white border-4 border-black p-0 shadow-retro overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-black">
                        <thead class="bg-brand-yellow">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-black uppercase tracking-widest text-black border-r-2 border-black">Produk</th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-black uppercase tracking-widest text-black border-r-2 border-black">Kategori</th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-black uppercase tracking-widest text-black border-r-2 border-black">Harga</th>
                                <th scope="col" class="px-6 py-4 text-center text-sm font-black uppercase tracking-widest text-black border-r-2 border-black">Status</th>
                                <th scope="col" class="px-6 py-4 text-center text-sm font-black uppercase tracking-widest text-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y-2 divide-black">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-200">
                                        <div class="flex items-center">
                                            <div class="h-12 w-12 flex-shrink-0 border-2 border-black bg-gray-100 overflow-hidden">
                                                @if ($product->image)
                                                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $product->image) }}" alt="">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-gray-400 text-xs font-bold uppercase">No Pic</div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900 uppercase">{{ $product->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-200">
                                        <span class="px-2 py-1 bg-gray-100 border border-black text-xs font-bold uppercase">
                                            {{ $product->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-200">
                                        <div class="text-sm font-bold font-mono">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center border-r-2 border-gray-200">
                                        @if ($product->is_available)
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                                Ready
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-black uppercase bg-red-200 text-red-900 border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                                Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-black hover:bg-indigo-100 p-1 border-2 border-transparent hover:border-indigo-600 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline-block" onsubmit="return confirm('Yakin hapus {{ $product->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-white hover:bg-red-600 p-1 border-2 border-transparent hover:border-black transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center bg-gray-50">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-12 h-12 mb-3 border-2 border-gray-300 rounded-full p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                            <span class="font-bold uppercase tracking-widest">Belum ada menu</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="settings-modal" focusable>
        <div class="bg-white border-4 border-black p-0 shadow-retro">
            <div class="bg-brand-yellow p-4 border-b-4 border-black">
                <h2 class="text-xl font-display uppercase tracking-tight text-black">
                    Pengaturan Biaya
                </h2>
                <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mt-1">
                    Pajak & Layanan Aplikasi
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" class="p-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-sm uppercase mb-2">Pajak (%)</label>
                        <div class="relative group">
                            <input type="number" name="tax_percent" step="0.01" value="{{ $tax->value ?? 0 }}" 
                                   class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-bold text-lg" required>
                            <span class="absolute right-3 top-3 font-bold text-gray-400">%</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block font-bold text-sm uppercase mb-2">Layanan (%)</label>
                        <div class="relative group">
                            <input type="number" name="service_percent" step="0.01" value="{{ $service->value ?? 0 }}" 
                                   class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-bold text-lg" required>
                            <span class="absolute right-3 top-3 font-bold text-gray-400">%</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 pt-4 border-t-2 border-dashed border-gray-300">
                    <button type="button" x-on:click="$dispatch('close')" class="px-6 py-2 bg-white border-2 border-black font-bold uppercase hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2 bg-black text-brand-yellow border-2 border-transparent font-bold uppercase hover:bg-brand-yellow hover:text-black hover:border-black shadow-retro-sm active:shadow-none active:translate-x-1 active:translate-y-1 transition-all">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

</x-app-layout>