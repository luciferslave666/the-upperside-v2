<x-app-layout>
    @vite('resources/css/app.css')

    <x-slot name="header">
        <div class="flex items-center gap-4 pb-6 border-b border-gray-200">
            <a href="{{ route('admin.tables.index') }}" 
               class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">
                    {{ __('Tambah Meja') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Buat meja baru untuk restoran</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Meja</h3>
                    </div>
                    <p class="text-sm text-gray-500">Masukkan nama atau nomor meja yang akan ditambahkan</p>
                </div>

                <form method="POST" action="{{ route('admin.tables.store') }}" class="space-y-6">
                    @csrf 

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama / Nomor Meja</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" 
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               required autofocus placeholder="Contoh: Meja 01 atau Table A">
                        
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.tables.index') }}" 
                           class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Meja
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>