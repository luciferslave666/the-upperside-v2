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
            <h2 class="font-display text-3xl uppercase tracking-tight text-brand-black">
                {{ __('Kitchen Display') }}
            </h2>
            <span class="bg-brand-yellow px-2 border-2 border-black font-bold text-sm transform -rotate-2">LIVE</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-brand-yellow border-2 border-black shadow-retro-sm flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- KANBAN WRAPPER --}}
            <div id="kanban-board-container">
                @include('pos._kanban-board', [
                    'pendingOrders' => $pendingOrders,
                    'paidOrders' => $paidOrders,
                    'processingOrders' => $processingOrders
                ])
            </div>

        </div>
    </div>

    {{-- SCRIPT AUTO REFRESH --}}
    <script>
        const fetchKanbanData = () => {
            fetch("{{ route('pos.boardData') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById('kanban-board-container').innerHTML = html;
                })
                .catch(error => console.error('Error fetching kanban data:', error));
        };
        // Refresh setiap 10 detik agar tidak terlalu berat
        setInterval(fetchKanbanData, 10000);
    </script>

</x-app-layout>