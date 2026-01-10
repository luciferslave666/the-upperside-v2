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
            <a href="{{ route('admin.users.index') }}" class="p-2 border-2 border-black bg-white hover:bg-black hover:text-white transition shadow-retro-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black">
                {{ __('Tambah User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white border-4 border-black p-8 shadow-retro relative">
                
                <div class="absolute -top-3 -right-3 bg-brand-yellow text-black border-2 border-black px-3 py-1 font-bold text-xs uppercase shadow-sm rotate-3">
                    New Account
                </div>

                <div class="mb-8 text-center border-b-2 border-dashed border-gray-300 pb-6">
                    <div class="inline-block p-3 bg-brand-purple border-2 border-black rounded-full mb-4 shadow-retro-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </div>
                    <h3 class="font-bold text-xl uppercase">Registrasi Akun</h3>
                    <p class="text-sm text-gray-500 mt-1">Tambahkan admin atau staf baru ke sistem.</p>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf 

                    <div>
                        <label for="name" class="block font-bold text-sm uppercase mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" 
                               class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                               required autofocus placeholder="Contoh: Budi Santoso">
                        @error('name')
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block font-bold text-sm uppercase mb-2">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" 
                               class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                               required placeholder="nama@theupperside.com">
                        @error('email')
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block font-bold text-sm uppercase mb-2">Role / Jabatan</label>
                        <div class="relative">
                            <select name="role" id="role" class="block w-full p-3 bg-gray-50 border-2 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-medium appearance-none cursor-pointer" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>👑 Admin (Owner)</option>
                                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>👷 Karyawan (Kasir/Dapur)</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 bg-gray-200 border-l-2 border-black">
                                <svg class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </span>
                        </div>
                        @error('role')
                            <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-gray-100 border-2 border-dashed border-black p-4 space-y-4">
                        <div>
                            <label for="password" class="block font-bold text-sm uppercase mb-2">Password</label>
                            <input id="password" name="password" type="password" 
                                   class="block w-full p-3 bg-white border-2 border-black focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                                   required autocomplete="new-password" placeholder="••••••••">
                            @error('password')
                                <p class="text-red-600 text-xs font-bold mt-1 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block font-bold text-sm uppercase mb-2">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                   class="block w-full p-3 bg-white border-2 border-black focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all placeholder-gray-400 font-medium" 
                                   required placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t-2 border-dashed border-gray-300">
                        <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border-2 border-transparent text-gray-500 font-bold uppercase hover:text-black transition">
                            &larr; Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-black text-brand-yellow font-bold uppercase tracking-wider border-2 border-transparent hover:bg-brand-yellow hover:text-black hover:border-black hover:shadow-retro-sm transition-all active:translate-y-1 active:shadow-none shadow-md">
                            Simpan User
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>