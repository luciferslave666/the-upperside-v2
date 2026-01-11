<x-app-layout>
    @vite('resources/css/app.css')

    <x-slot name="header">
        <div class="flex items-center gap-4 pb-6 border-b border-gray-200">
            <a href="{{ route('admin.products.index') }}" 
               class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">
                    Edit Produk
                </h2>
                <p class="text-sm text-gray-500 mt-1">{{ $product->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf 
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $product->name) }}" 
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                        
                        <div class="flex items-start gap-6">
                            @if ($product->image)
                                <div class="flex-shrink-0">
                                    <div class="text-xs font-medium text-gray-500 mb-2">Gambar Saat Ini</div>
                                    <div class="w-24 h-24 rounded-lg overflow-hidden border border-gray-200">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            @endif

                            <div class="flex-grow">
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                                <span>Upload file baru</span>
                                                <input id="image" name="image" type="file" class="sr-only">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" id="category_id" 
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <div class="relative rounded-lg">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input id="price" name="price" type="number" min="0" value="{{ old('price', $product->price) }}" 
                                       class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                       required>
                            </div>
                            @error('price') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="is_available" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="is_available" id="is_available" 
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="1" {{ old('is_available', $product->is_available) == 1 ? 'selected' : '' }}>Tersedia</option>
                                <option value="0" {{ old('is_available', $product->is_available) == 0 ? 'selected' : '' }}>Habis</option>
                            </select>
                            @error('is_available') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                        <textarea id="description" name="description" rows="3" 
                                  class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none">{{ old('description', $product->description) }}</textarea>
                        @error('description') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.products.index') }}" 
                           class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Update Produk
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>