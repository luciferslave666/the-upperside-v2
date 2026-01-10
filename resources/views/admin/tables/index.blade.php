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
            <div class="flex items-center gap-3">
                <div class="bg-brand-purple text-white p-2 border-2 border-black shadow-retro-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 100-4 2 2 0 000 4zm-6-2a2 2 0 100-4 2 2 0 000 4zm6-2a2 2 0 100-4 2 2 0 000 4zm-6-2a2 2 0 100-4 2 2 0 000 4z"/></svg>
                </div>
                <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black">
                    {{ __('Manajemen Meja') }}
                </h2>
            </div>

            <a href="{{ route('admin.tables.create') }}" 
               class="px-6 py-3 bg-black text-brand-yellow font-bold uppercase tracking-wider border-2 border-transparent hover:bg-brand-yellow hover:text-black hover:border-black hover:shadow-retro-sm transition-all active:translate-y-1 active:shadow-none flex items-center gap-2">
                <span>+ Meja Baru</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-2 border-black shadow-retro-sm flex items-center gap-3 text-green-900">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-bold uppercase tracking-wide">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white border-4 border-black p-0 shadow-retro">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-black">
                        <thead class="bg-brand-yellow">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-black uppercase tracking-widest text-black border-r-2 border-black w-1/2">
                                    Nama / Nomor Meja
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-sm font-black uppercase tracking-widest text-black w-1/2">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y-2 divide-black">
                            @forelse ($tables as $table)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap border-r-2 border-gray-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gray-100 border-2 border-black flex items-center justify-center font-display text-lg shadow-sm group-hover:bg-brand-purple group-hover:text-white transition-colors">
                                                {{ substr($table->name, 0, 1) }}
                                            </div>
                                            <div class="text-lg font-bold text-gray-900 uppercase tracking-tight">{{ $table->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center items-center gap-4">
                                            <a href="{{ route('admin.tables.edit', $table) }}" 
                                               class="inline-flex items-center gap-1 px-3 py-1 bg-white border-2 border-black text-black text-xs font-bold uppercase hover:bg-brand-yellow transition shadow-sm hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            
                                            <form method="POST" action="{{ route('admin.tables.destroy', $table) }}" class="inline-block" onsubmit="return confirm('Yakin hapus meja {{ $table->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 border-2 border-black text-red-700 text-xs font-bold uppercase hover:bg-red-600 hover:text-white transition shadow-sm hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-12 text-center bg-gray-50">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <div class="w-16 h-16 border-2 border-gray-300 rounded-full flex items-center justify-center mb-3">
                                                <span class="text-3xl">🪑</span>
                                            </div>
                                            <span class="font-bold uppercase tracking-widest text-sm">Belum ada meja</span>
                                            <p class="text-xs mt-1">Tambahkan meja baru untuk memulai.</p>
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
</x-app-layout>