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
            <a href="{{ route('admin.products.index') }}" class="p-2 border-2 border-black bg-white hover:bg-black hover:text-white transition shadow-retro-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black">
                {{ __('Tambah Produk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white border-4 border-black p-8 shadow-retro relative">
                <div class="absolute -top-3 right-8 bg-brand-yellow border-2 border-black px-4 py-1 font-bold text-xs uppercase shadow-sm rotate-2">
                    New Item Entry
                </div>

                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf 

                    <div>
                        <label for="name" class="block font-bold text-sm uppercase mb-2">Nama Produk</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" 
                               class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                               required autofocus placeholder="Contoh: Kopi Susu Gula Aren">
                        @error('name')
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block font-bold text-sm uppercase mb-2">Gambar Produk (Opsional)</label>
                        <div class="relative border-2 border-black bg-gray-50 p-1 hover:bg-white transition-colors">
                            <input id="image" name="image" type="file" 
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:border-0 file:border-r-2 file:border-black
                                          file:text-sm file:font-bold file:uppercase
                                          file:bg-brand-purple file:text-white
                                          hover:file:bg-black hover:file:text-white
                                          file:cursor-pointer cursor-pointer">
                        </div>
                        @error('image')
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ 
                            open: false, 
                            selectedId: '{{ old('category_id') }}', 
                            selectedName: 'Pilih Kategori',
                            categories: {{ $categories->toJson() }} 
                        }" 
                        x-init="if(selectedId) { const found = categories.find(c => c.id == selectedId); if(found) selectedName = found.name; }">
                        
                        <label class="block font-bold text-sm uppercase mb-2">Kategori</label>
                        <input type="hidden" name="category_id" x-model="selectedId">

                        <div class="relative">
                            <button type="button" @click="open = !open" 
                                    class="relative w-full cursor-pointer bg-gray-50 border-2 border-black py-3 pl-3 pr-10 text-left focus:outline-none focus:shadow-retro-input transition-all">
                                <span class="block truncate font-medium" x-text="selectedName"></span>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 border-l-2 border-black bg-gray-200 px-3">
                                    <svg class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <ul x-show="open" @click.away="open = false" 
                                class="absolute z-20 mt-1 max-h-60 w-full overflow-auto bg-white border-2 border-black shadow-retro-sm py-0 text-base focus:outline-none sm:text-sm" 
                                style="display: none;"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100">
                                
                                <template x-for="category in categories" :key="category.id">
                                    <li class="relative cursor-pointer select-none py-3 pl-3 pr-9 hover:bg-brand-yellow hover:font-bold border-b border-gray-200 last:border-0 transition-colors group flex justify-between items-center">
                                        <div @click="selectedId = category.id; selectedName = category.name; open = false" class="flex-grow">
                                            <span class="block truncate" x-text="category.name"></span>
                                        </div>
                                        <button type="button" @click="$dispatch('open-modal', 'delete-category-' + category.id)" 
                                                class="text-gray-400 hover:text-red-600 px-3 border-l border-gray-200 z-20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </li>
                                </template>

                                <li @click="$dispatch('open-modal', 'add-category-modal'); open = false" 
                                    class="relative cursor-pointer select-none py-3 pl-3 pr-9 bg-gray-50 text-brand-purple hover:bg-brand-purple hover:text-white border-t-2 border-black font-bold uppercase text-xs tracking-wider transition-colors text-center">
                                    + Tambah Kategori Baru
                                </li>
                            </ul>
                        </div>
                        @error('category_id') 
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="block font-bold text-sm uppercase mb-2">Harga (Rp)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center px-3 bg-gray-200 border-2 border-black font-bold text-gray-600 text-sm">Rp</span>
                                <input id="price" name="price" type="number" min="0" value="{{ old('price') }}" 
                                       class="block w-full pl-12 p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                                       required placeholder="0">
                            </div>
                            @error('price')
                                <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="is_available" class="block font-bold text-sm uppercase mb-2">Status</label>
                            <div class="relative">
                                <select name="is_available" id="is_available" class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-medium appearance-none cursor-pointer">
                                    <option value="1" {{ old('is_available', 1) == 1 ? 'selected' : '' }}>🟢 Tersedia</option>
                                    <option value="0" {{ old('is_available') == 0 ? 'selected' : '' }}>🔴 Habis</option>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 bg-gray-200 border-l-2 border-black">
                                    <svg class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </span>
                            </div>
                            @error('is_available')
                                <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block font-bold text-sm uppercase mb-2">Deskripsi (Opsional)</label>
                        <textarea id="description" name="description" rows="3" 
                                  class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium resize-none"
                                  placeholder="Jelaskan detail rasa atau bahan..."></textarea>
                        @error('description')
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t-2 border-dashed border-gray-300 mt-8">
                        <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border-2 border-black bg-white text-black font-bold uppercase tracking-wider hover:bg-gray-100 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-black text-brand-yellow font-bold uppercase tracking-wider border-2 border-transparent hover:bg-brand-yellow hover:text-black hover:border-black hover:shadow-retro-sm transition-all active:translate-y-1 active:shadow-none shadow-md">
                            Simpan Produk
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <x-modal name="add-category-modal" focusable>
        <div class="p-6 bg-white border-4 border-black">
            <h2 class="text-xl font-display uppercase mb-4">Buat Kategori Baru</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-6">
                    <label class="block font-bold text-sm uppercase mb-2">Nama Kategori</label>
                    <input type="text" name="name" class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:shadow-retro-input outline-none font-bold" required placeholder="Misal: Minuman Dingin">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border-2 border-black font-bold uppercase hover:bg-gray-100">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-brand-purple text-white border-2 border-black font-bold uppercase shadow-retro-sm hover:translate-y-0.5 hover:shadow-none transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </x-modal>

    @foreach ($categories as $category)
        <x-modal name="delete-category-{{ $category->id }}" focusable>
            <div class="p-6 bg-white border-4 border-black text-center">
                <div class="w-12 h-12 bg-red-100 border-2 border-black rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                <h2 class="text-xl font-display uppercase mb-2">Hapus Kategori?</h2>
                <p class="text-gray-600 mb-6 font-medium">
                    Yakin mau menghapus <span class="font-bold text-black underline decoration-brand-yellow">{{ $category->name }}</span>? Produk di kategori ini mungkin akan kehilangan kategorinya.
                </p>
                <div class="flex justify-center gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border-2 border-black font-bold uppercase hover:bg-gray-100">Batal</button>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white border-2 border-black font-bold uppercase shadow-retro-sm hover:translate-y-0.5 hover:shadow-none transition-all">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </x-modal>
    @endforeach

</x-app-layout>