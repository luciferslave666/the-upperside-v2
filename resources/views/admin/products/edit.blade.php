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
            <a href="{{ route('admin.products.index') }}" class="p-2 border-2 border-black bg-white hover:bg-black hover:text-white transition shadow-retro-sm w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black leading-none">
                    Edit Produk
                </h2>
                <span class="inline-block mt-1 bg-brand-purple text-white px-2 py-0.5 text-xs font-bold uppercase border border-black transform rotate-1">
                    {{ $product->name }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white border-4 border-black p-8 shadow-retro relative">
                <div class="absolute -top-3 right-8 bg-black text-brand-yellow border-2 border-brand-yellow px-4 py-1 font-bold text-xs uppercase shadow-sm -rotate-1">
                    Editing Mode
                </div>

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf 
                    @method('PATCH')

                    <div>
                        <label for="name" class="block font-bold text-sm uppercase mb-2">Nama Produk</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $product->name) }}" 
                               class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                               required>
                        @error('name')
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-gray-100 border-2 border-dashed border-black p-4">
                        <label for="image" class="block font-bold text-sm uppercase mb-2">Ganti Gambar (Opsional)</label>
                        
                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            @if ($product->image)
                                <div class="flex-shrink-0 text-center">
                                    <span class="block text-[10px] font-bold uppercase mb-1 bg-black text-white inline-block px-1">Saat Ini</span>
                                    <div class="border-2 border-black p-1 bg-white shadow-retro-sm">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-24 w-24 object-cover grayscale hover:grayscale-0 transition-all">
                                    </div>
                                </div>
                            @endif

                            <div class="flex-grow w-full">
                                <div class="relative border-2 border-black bg-white p-1 hover:bg-gray-50 transition-colors">
                                    <input id="image" name="image" type="file" 
                                           class="block w-full text-sm text-gray-500
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:border-0 file:border-r-2 file:border-black
                                                  file:text-sm file:font-bold file:uppercase
                                                  file:bg-brand-yellow file:text-black
                                                  hover:file:bg-black hover:file:text-white
                                                  file:cursor-pointer cursor-pointer">
                                </div>
                                <p class="text-xs text-gray-500 mt-2 font-medium">Format: JPG, PNG, JPEG. Max: 2MB.</p>
                                @error('image')
                                    <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="category_id" class="block font-bold text-sm uppercase mb-2">Kategori</label>
                        <div class="relative">
                            <select name="category_id" id="category_id" 
                                    class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-medium appearance-none cursor-pointer">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 bg-gray-200 border-l-2 border-black">
                                <svg class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </span>
                        </div>
                        @error('category_id') <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="block font-bold text-sm uppercase mb-2">Harga (Rp)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center px-3 bg-gray-200 border-2 border-black font-bold text-gray-600 text-sm">Rp</span>
                                <input id="price" name="price" type="number" min="0" value="{{ old('price', $product->price) }}" 
                                       class="block w-full pl-12 p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                                       required>
                            </div>
                            @error('price') <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="is_available" class="block font-bold text-sm uppercase mb-2">Status</label>
                            <div class="relative">
                                <select name="is_available" id="is_available" class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-medium appearance-none cursor-pointer">
                                    <option value="1" {{ old('is_available', $product->is_available) == 1 ? 'selected' : '' }}>🟢 Tersedia</option>
                                    <option value="0" {{ old('is_available', $product->is_available) == 0 ? 'selected' : '' }}>🔴 Habis</option>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 bg-gray-200 border-l-2 border-black">
                                    <svg class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </span>
                            </div>
                            @error('is_available') <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block font-bold text-sm uppercase mb-2">Deskripsi (Opsional)</label>
                        <textarea id="description" name="description" rows="3" 
                                  class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium resize-none">{{ old('description', $product->description) }}</textarea>
                        @error('description') <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t-2 border-dashed border-gray-300 mt-8">
                        <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border-2 border-black bg-white text-black font-bold uppercase tracking-wider hover:bg-gray-100 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-black text-brand-yellow font-bold uppercase tracking-wider border-2 border-transparent hover:bg-brand-yellow hover:text-black hover:border-black hover:shadow-retro-sm transition-all active:translate-y-1 active:shadow-none shadow-md">
                            Update Produk
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>