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
            <div class="p-2 border-2 border-black bg-brand-yellow shadow-retro-sm">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black">
                {{ __('Pengaturan Biaya') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen font-body text-brand-black">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-brand-yellow border-2 border-black shadow-retro-sm flex items-center gap-3">
                    <div class="bg-black text-white p-1 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    <span class="font-bold uppercase tracking-wide">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white border-4 border-black p-8 shadow-retro relative">
                
                <div class="absolute -top-3 -right-3 bg-brand-purple border-2 border-black w-8 h-8"></div>
                <div class="absolute -bottom-3 -left-3 bg-brand-yellow border-2 border-black w-8 h-8"></div>

                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf 
                    
                    <div class="mb-8 text-center border-b-2 border-black pb-6">
                        <h3 class="font-display text-2xl uppercase mb-2">Konfigurasi Tagihan</h3>
                        <p class="font-bold text-gray-500 text-sm">Atur persentase pajak dan layanan yang akan dibebankan ke pelanggan.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <label for="tax_percent" class="block font-display text-lg uppercase mb-2">Pajak Restoran (PB1)</label>
                            <div class="relative group">
                                <input id="tax_percent" name="tax_percent" type="number" step="0.01" 
                                       value="{{ old('tax_percent', $tax->value) }}" 
                                       class="block w-full p-4 bg-gray-50 border-4 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-display text-3xl" required>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 font-display text-2xl text-gray-400 select-none">%</div>
                            </div>
                            @error('tax_percent')
                                <p class="text-red-600 text-xs font-bold mt-2 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                            @enderror
                            <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-wide">Contoh: Isi 10 untuk 10%</p>
                        </div>

                        <div>
                            <label for="service_percent" class="block font-display text-lg uppercase mb-2">Biaya Layanan</label>
                            <div class="relative group">
                                <input id="service_percent" name="service_percent" type="number" step="0.01" 
                                       value="{{ old('service_percent', $service->value) }}" 
                                       class="block w-full p-4 bg-gray-50 border-4 border-black focus:bg-white focus:ring-0 focus:outline-none focus:shadow-retro-input transition-all font-display text-3xl" required>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 font-display text-2xl text-gray-400 select-none">%</div>
                            </div>
                            @error('service_percent')
                                <p class="text-red-600 text-xs font-bold mt-2 bg-red-100 p-1 border border-red-500 inline-block uppercase">{{ $message }}</p>
                            @enderror
                            <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-wide">Biasanya 5% - 10%</p>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t-2 border-dashed border-black flex justify-end">
                        <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-black text-brand-yellow border-2 border-transparent font-display text-xl uppercase tracking-wider hover:bg-brand-yellow hover:text-black hover:border-black hover:shadow-retro-sm transition-all active:translate-y-1 active:shadow-none shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>