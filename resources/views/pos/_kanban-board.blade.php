<div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

    <div class="flex flex-col h-full">
        <div class="bg-brand-yellow border-4 border-black p-4 shadow-retro mb-6 relative">
            <h3 class="font-display text-xl uppercase leading-none">Menunggu <br>Bayar</h3>
            <div class="absolute top-2 right-2 bg-black text-white w-8 h-8 flex items-center justify-center font-bold border-2 border-white rounded-full">
                {{ $pendingOrders->count() }}
            </div>
        </div>

        <div class="space-y-6">
            @forelse ($pendingOrders as $order)
                <div class="bg-white border-2 border-black p-5 shadow-retro-sm relative group hover:-translate-y-1 transition-transform duration-200">
                    <div class="flex justify-between items-start mb-3 border-b-2 border-dashed border-gray-300 pb-2">
                        <div>
                            <span class="bg-black text-white px-2 py-0.5 font-display text-lg">#{{ $order->id }}</span>
                            <span class="font-bold text-gray-500 text-sm ml-2">{{ $order->created_at->format('H:i') }}</span>
                        </div>
                        <div class="bg-gray-100 border border-black px-2 py-1 font-bold text-xs">
                            MEJA {{ $order->table->name }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="font-bold text-lg leading-none">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-500 font-bold uppercase">{{ $order->number_of_people }} Orang</p>
                    </div>
                    
                    <ul class="text-sm font-mono space-y-1 mb-4 border-l-4 border-gray-200 pl-3">
                        @foreach ($order->orderItems as $item)
                            <li class="flex justify-between">
                                <span>{{ $item->product->name }}</span>
                                <span class="font-bold">x{{ $item->quantity }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between items-center mt-4 pt-3 border-t-2 border-black">
                        <p class="font-display text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('pos.order.updateStatus', $order) }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="w-full py-2 px-4 bg-black text-white font-bold uppercase border-2 border-transparent hover:bg-white hover:text-black hover:border-black transition-colors shadow-sm">
                            Mark Paid &rarr;
                        </button>
                    </form>
                </div>
            @empty
                <div class="border-2 border-dashed border-gray-400 p-8 text-center text-gray-400 font-bold">
                    KASIR SEPI
                </div>
            @endforelse
        </div>
    </div>

    <div class="flex flex-col h-full">
        <div class="bg-white border-4 border-black p-4 shadow-retro mb-6 relative">
            <h3 class="font-display text-xl uppercase leading-none">Antrian <br>Dapur</h3>
            <div class="absolute top-2 right-2 bg-brand-purple text-white w-8 h-8 flex items-center justify-center font-bold border-2 border-black rounded-full">
                {{ $paidOrders->count() }}
            </div>
        </div>

        <div class="space-y-6">
            @forelse ($paidOrders as $order)
                <div class="bg-white border-2 border-black p-5 shadow-retro-sm hover:-translate-y-1 transition-transform duration-200 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-brand-purple"></div>

                    <div class="flex justify-between items-start mb-3 border-b-2 border-dashed border-gray-300 pb-2 pl-2">
                        <div>
                            <span class="bg-brand-purple text-white px-2 py-0.5 font-display text-lg">#{{ $order->id }}</span>
                            <span class="font-bold text-gray-500 text-sm ml-2">{{ $order->created_at->format('H:i') }}</span>
                        </div>
                        <div class="bg-brand-yellow border border-black px-2 py-1 font-bold text-xs">
                            MEJA {{ $order->table->name }}
                        </div>
                    </div>

                    <div class="pl-2 mb-4">
                        <p class="font-bold text-lg leading-none">{{ $order->customer_name }}</p>
                    </div>
                    
                    <ul class="text-sm font-bold space-y-2 mb-4 pl-2">
                        @foreach ($order->orderItems as $item)
                            <li class="flex items-start gap-2">
                                <div class="bg-black text-white w-5 h-5 flex items-center justify-center text-xs flex-shrink-0 mt-0.5">{{ $item->quantity }}</div>
                                <span>{{ $item->product->name }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('pos.order.updateStatus', $order) }}" method="POST" class="mt-4 pl-2">
                        @csrf
                        <input type="hidden" name="status" value="processing">
                        <button type="submit" class="w-full py-2 px-4 bg-brand-purple text-white font-bold uppercase border-2 border-black hover:bg-white hover:text-brand-purple transition-colors shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">
                            Masak Sekarang 🔥
                        </button>
                    </form>
                </div>
            @empty
                <div class="border-2 border-dashed border-gray-400 p-8 text-center text-gray-400 font-bold">
                    DAPUR SANTAI
                </div>
            @endforelse
        </div>
    </div>

    <div class="flex flex-col h-full">
        <div class="bg-brand-purple border-4 border-black p-4 shadow-retro mb-6 relative text-white">
            <h3 class="font-display text-xl uppercase leading-none">Sedang <br>Dimasak</h3>
            <div class="absolute top-2 right-2 bg-white text-black w-8 h-8 flex items-center justify-center font-bold border-2 border-black rounded-full">
                {{ $processingOrders->count() }}
            </div>
        </div>

        <div class="space-y-6">
            @forelse ($processingOrders as $order)
                <div class="bg-white border-2 border-black p-5 shadow-retro-sm relative">
                    <div class="absolute bottom-0 left-0 h-1 bg-green-500 animate-pulse w-full"></div>

                    <div class="flex justify-between items-start mb-3 border-b-2 border-dashed border-gray-300 pb-2">
                        <div>
                            <span class="bg-gray-200 text-black border border-black px-2 py-0.5 font-display text-lg">#{{ $order->id }}</span>
                        </div>
                        <div class="bg-green-100 border border-green-600 text-green-800 px-2 py-1 font-bold text-xs uppercase animate-pulse">
                            Cooking...
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="font-bold text-lg">Meja {{ $order->table->name }}</p>
                        <p class="text-sm text-gray-500">{{ $order->customer_name }}</p>
                    </div>
                    
                    <ul class="text-sm font-mono space-y-1 mb-4">
                        @foreach ($order->orderItems as $item)
                            <li class="flex justify-between text-gray-600">
                                <span>{{ $item->product->name }}</span>
                                <span class="font-bold text-black">x{{ $item->quantity }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('pos.order.updateStatus', $order) }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="w-full py-2 px-4 bg-green-500 text-white font-bold uppercase border-2 border-black hover:bg-green-600 transition-colors shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">
                            Selesai & Antar ✅
                        </button>
                    </form>
                </div>
            @empty
                <div class="border-2 border-dashed border-gray-400 p-8 text-center text-gray-400 font-bold">
                    KOMPOR DINGIN
                </div>
            @endforelse
        </div>
    </div>

</div>