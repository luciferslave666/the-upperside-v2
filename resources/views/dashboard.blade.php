<x-app-layout>
    @vite('resources/css/app.css')

    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Overview kinerja bisnis Anda</p>
            </div>
            
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Revenue Today -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            +12%
                        </span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Pendapatan Hari Ini</h3>
                    <p class="text-2xl font-semibold text-gray-900">
                        Rp {{ number_format($revenueToday, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Orders Today -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-500">{{ $ordersTodayCount }} transaksi</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Pesanan Hari Ini</h3>
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ $ordersTodayCount }} <span class="text-base font-normal text-gray-600">pesanan</span>
                    </p>
                </div>

                <!-- Pending Orders -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                            Perlu Tindakan
                        </span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Menunggu Pembayaran</h3>
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ $pendingOrdersCount }} <span class="text-base font-normal text-gray-600">pesanan</span>
                    </p>
                </div>
            </div>

            <!-- Charts & Lists -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Sales Chart -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Analitik Penjualan</h3>
                        <div class="relative">
                            <select class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-10 text-sm font-medium text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent cursor-pointer">
                                <option>7 Hari Terakhir</option>
                                <option>30 Hari Terakhir</option>
                                <option>Bulan Ini</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative w-full h-80">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Menu Favorit</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Top 5
                        </span>
                    </div>

                    @if($topSellingProducts->isEmpty())
                        <div class="flex-1 flex flex-col items-center justify-center text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-500">Belum ada data penjualan</p>
                        </div>
                    @else
                        <div class="flex-1 space-y-4 overflow-y-auto" style="max-height: 320px;">
                            @foreach ($topSellingProducts as $item)
                                <div class="flex items-center justify-between pb-4 border-b border-gray-100 last:border-0">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <div class="w-8 h-8 flex-shrink-0 bg-blue-50 rounded-lg flex items-center justify-center">
                                            <span class="text-sm font-semibold text-blue-600">{{ $loop->iteration }}</span>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h4 class="text-sm font-medium text-gray-900 truncate">{{ $item->product_name }}</h4>
                                            <p class="text-xs text-gray-500 mt-0.5">{{ $item->total_sold }} terjual</p>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ number_format(($item->total_sold / $topSellingProducts->sum('total_sold')) * 100, 0) }}%
                                        </span>
                                        <div class="w-16 h-1.5 bg-gray-100 rounded-full mt-1.5 overflow-hidden">
                                            <div class="h-full bg-blue-500 rounded-full" style="width: {{ ($item->total_sold / $topSellingProducts->max('total_sold')) * 100 }}%"></div>
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
            
            Chart.defaults.font.family = "'Inter', 'system-ui', sans-serif";
            Chart.defaults.color = '#6B7280';

            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Pendapatan',
                        data: [1200000, 1900000, 1500000, 2200000, 1800000, 2500000, 2100000],
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        pointBackgroundColor: '#3B82F6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1F2937',
                            titleColor: '#fff',
                            bodyColor: '#E5E7EB',
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: { 
                                color: '#F3F4F6',
                                drawTicks: false
                            },
                            ticks: {
                                padding: 10,
                                color: '#6B7280',
                                font: { size: 12 },
                                callback: function(value) { 
                                    return 'Rp ' + (value / 1000000) + 'jt'; 
                                }
                            }
                        },
                        x: {
                            border: { display: false },
                            grid: { display: false },
                            ticks: { 
                                padding: 10,
                                color: '#6B7280',
                                font: { size: 12 }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>