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
                    Edit Meja
                </h2>
                <p class="text-sm text-gray-500 mt-1">{{ $table->name }}</p>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Edit Informasi Meja</h3>
                    </div>
                    <p class="text-sm text-gray-500">Perbarui nama atau nomor meja di bawah ini</p>
                </div>

                <form method="POST" action="{{ route('admin.tables.update', $table) }}" class="space-y-6">
                    @csrf 
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama / Nomor Meja</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $table->name) }}" 
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               required autofocus>
                        
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
                            Update Meja
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>