<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $order->id }} - The Upperside</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body {
                margin: 0;
                padding: 10px;
                font-size: 12px;
                width: 80mm;
            }
            .no-print {
                display: none;
            }
        }
        .receipt {
            width: 80mm;
            margin: 0 auto;
            font-family: monospace;
            font-size: 12px;
        }
    </style>
</head>
<body class="bg-gray-100 p-4">

    <div class="receipt bg-white border-2 border-black p-4 shadow-sm">
        <!-- Header -->
        <div class="text-center border-b-2 border-black pb-3 mb-3">
            <p class="font-bold text-lg">THE UPPERSIDE</p>
            <p class="text-xs">Cafe & Resto</p>
            <p class="text-xs text-gray-600 mt-1">{{ now()->format('d/m/Y H:i:s') }}</p>
        </div>

        <!-- Order Info -->
        <div class="text-xs mb-3 border-b-2 border-black pb-3">
            <div class="flex justify-between">
                <span>Order #</span>
                <span class="font-bold">{{ $order->id }}</span>
            </div>
            <div class="flex justify-between">
                <span>Meja</span>
                <span class="font-bold">{{ $order->table->name }}</span>
            </div>
            <div class="flex justify-between">
                <span>Nama</span>
                <span class="font-bold">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between">
                <span>Orang</span>
                <span class="font-bold">{{ $order->number_of_people }}</span>
            </div>
        </div>

        <!-- Items -->
        <div class="text-xs mb-3 border-b-2 border-black pb-3">
            @foreach($order->orderItems as $item)
            <div class="flex justify-between mb-2">
                <div class="flex-1">
                    <p class="font-bold">{{ $item->product->name }}</p>
                    <p class="text-gray-600">x{{ $item->quantity }} @ Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
                <p class="font-bold text-right ml-2">Rp{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>

        <!-- Totals -->
        <div class="text-xs mb-3">
            <div class="flex justify-between mb-1">
                <span>Subtotal</span>
                <span>Rp{{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            @if($order->service_fee_amount > 0)
            <div class="flex justify-between mb-1">
                <span>Biaya Layanan</span>
                <span>Rp{{ number_format($order->service_fee_amount, 0, ',', '.') }}</span>
            </div>
            @endif
            @if($order->tax_amount > 0)
            <div class="flex justify-between mb-1">
                <span>Pajak</span>
                <span>Rp{{ number_format($order->tax_amount, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="flex justify-between border-t-2 border-black pt-2 font-bold">
                <span>TOTAL</span>
                <span>Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-xs border-t-2 border-black pt-3">
            <p class="mb-2">Terima kasih atas kunjungan Anda!</p>
            <p class="text-gray-600">Enjoy Your Order</p>
        </div>
    </div>

    <!-- Print Button -->
    <div class="text-center mt-6 no-print">
        <button onclick="window.print()" class="px-6 py-2 bg-black text-white font-bold border-2 border-black">
            🖨️ Print Struk
        </button>
        <a href="{{ route('pos.index') }}" class="ml-2 px-6 py-2 bg-gray-300 text-black font-bold border-2 border-black">
            ← Kembali
        </a>
    </div>

</body>
</html>