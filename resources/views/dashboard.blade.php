<x-app-layout>
    @vite('resources/css/app.css')

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b-4 border-black pb-6">
            <div>
                <h2 class="font-display text-4xl text-brand-black uppercase tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-gray-600 font-bold mt-1">Overview Kinerja Bisnis</p>
            </div>
            
            <div class="inline-flex items-center gap-2 bg-brand-yellow border-2 border-black px-4 py-2 shadow-retro-sm transform -rotate-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="font-bold uppercase text-sm tracking-widest">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 font-body text-brand-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white border-4 border-black p-6 shadow-retro relative group hover:-translate-y-1 transition-transform duration-200">
                    <div class="flex items-center justify-between mb-4 relative z-10">
                        <div class="w-12 h-12 bg-brand-yellow border-2 border-black flex items-center justify-center shadow-retro-sm">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-black px-2 py-1 border-2 border-green-800 uppercase">
                            +12% Naik
                        </span>
                    </div>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-1">Pendapatan Hari Ini</h3>
                    <p class="font-display text-3xl text-brand-black">
                        Rp {{ number_format($revenueToday, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-brand-yellow border-4 border-black p-6 shadow-retro relative group hover:-translate-y-1 transition-transform duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white border-2 border-black flex items-center justify-center shadow-retro-sm">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <span class="bg-black text-white text-xs font-black px-2 py-1 border-2 border-transparent">
                            {{ $ordersTodayCount }} Transaksi
                        </span>
                    </div>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-black/60 mb-1">Pesanan Hari Ini</h3>
                    <p class="font-display text-3xl text-brand-black">
                        {{ $ordersTodayCount }} <span class="text-lg font-body font-bold">Pesanan</span>
                    </p>
                </div>

                <div class="bg-brand-purple border-4 border-black p-6 shadow-retro relative group hover:-translate-y-1 transition-transform duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white border-2 border-black flex items-center justify-center shadow-retro-sm">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="bg-yellow-300 text-black text-xs font-black px-2 py-1 border-2 border-black">
                            Action Needed
                        </span>
                    </div>
                    <h3 class="text-sm font-bold uppercase tracking-widest text-white/80 mb-1">Menunggu Bayar</h3>
                    <p class="font-display text-3xl text-white">
                        {{ $pendingOrdersCount }} <span class="text-lg font-body font-bold">Pesanan</span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white border-4 border-black p-6 shadow-retro">
                    <div class="flex items-center justify-between mb-6 border-b-2 border-black pb-4">
                        <h3 class="font-display text-xl uppercase">Analitik Penjualan</h3>
                        <div class="relative">
                            <select class="appearance-none bg-gray-100 border-2 border-black px-4 py-1 pr-8 font-bold text-sm focus:outline-none focus:bg-brand-yellow cursor-pointer">
                                <option>7 Hari Terakhir</option>
                                <option>30 Hari Terakhir</option>
                                <option>Bulan Ini</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative w-full h-80">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <div class="bg-white border-4 border-black p-6 shadow-retro flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6 border-b-2 border-black pb-4">
                        <h3 class="font-display text-xl uppercase">Menu Favorit</h3>
                        <span class="bg-brand-black text-white text-xs font-bold px-2 py-1">TOP 5</span>
                    </div>

                    @if($topSellingProducts->isEmpty())
                        <div class="flex-1 flex flex-col items-center justify-center text-center py-8">
                            <div class="w-16 h-16 bg-gray-200 border-2 border-black flex items-center justify-center mb-4">
                                <span class="text-3xl">💤</span>
                            </div>
                            <p class="font-bold text-gray-500">Belum ada data penjualan.</p>
                        </div>
                    @else
                        <div class="flex-1 space-y-4 overflow-y-auto pr-2" style="max-height: 300px;">
                            @foreach ($topSellingProducts as $item)
                                <div class="flex items-center justify-between group">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 flex-shrink-0 bg-brand-yellow border-2 border-black flex items-center justify-center font-display text-sm">
                                            {{ $loop->iteration }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-sm leading-tight group-hover:underline decoration-2">{{ $item->product_name }}</h4>
                                            <p class="text-xs text-gray-500 font-mono">{{ $item->total_sold }} terjual</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-display text-sm">
                                            {{ number_format(($item->total_sold / $topSellingProducts->sum('total_sold')) * 100, 0) }}%
                                        </span>
                                        <div class="w-16 h-2 bg-gray-200 border border-black mt-1">
                                            <div class="h-full bg-brand-purple" style="width: {{ ($item->total_sold / $topSellingProducts->max('total_sold')) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            
            // Font Global
            Chart.defaults.font.family = "'Space Grotesk', sans-serif";
            Chart.defaults.color = '#111';

            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Pendapatan',
                        data: [1200000, 1900000, 1500000, 2200000, 1800000, 2500000, 2100000],
                        borderColor: '#111',       
                        backgroundColor: '#DFFF4F', 
                        borderWidth: 3,
                        pointBackgroundColor: '#8A85D6', 
                        pointBorderColor: '#111',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        tension: 0, 
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // PERBAIKAN: Set ke false agar mengikuti tinggi container
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111',
                            titleColor: '#DFFF4F',
                            bodyColor: '#FFF',
                            titleFont: { family: "'Archivo Black'", size: 14 },
                            padding: 12,
                            cornerRadius: 0,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#e5e7eb', borderDash: [4, 4] },
                            ticks: {
                                color: '#666',
                                font: { weight: 'bold' },
                                callback: function(value) { return 'Rp ' + (value / 1000000) + 'jt'; }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#111', font: { weight: 'bold' } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>