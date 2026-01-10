<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu - The Upperside</title>
    
    <script type="text/javascript"
            src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-brand-black pb-32"> <header class="bg-brand-yellow border-b-4 border-black sticky top-0 z-40">
        <div class="px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-brand-black text-white flex items-center justify-center font-display text-xl border-2 border-white shadow-sm">U</div>
                <div>
                    <h1 class="font-display text-lg uppercase leading-none">The Upperside</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[10px] font-bold bg-white px-1.5 border border-black">
                            MEJA {{ App\Models\Table::find(session('order_details.table_id'))->name ?? '?' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-4 pb-4 overflow-x-auto no-scrollbar flex space-x-3">
            @foreach ($categories as $category)
                <a href="#category-{{ $category->id }}" class="category-tab px-4 py-2 bg-white border-2 border-black text-sm font-bold uppercase whitespace-nowrap shadow-retro-sm active:translate-y-1 active:shadow-none transition-all">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </header>

    <main class="container mx-auto max-w-2xl px-4 pt-6">
        <div class="bg-white border-2 border-black p-4 mb-8 shadow-retro-sm">
            <p class="text-xs font-bold text-gray-500 uppercase">Hai, Foodie!</p>
            <h2 class="font-display text-xl uppercase">Pesanan: {{ session('order_details.customer_name') }}</h2>
        </div>

        @foreach ($categories as $category)
            <div id="category-{{ $category->id }}" class="mb-8 scroll-mt-44">
                <h3 class="font-display text-2xl uppercase mb-4 border-b-4 border-brand-purple inline-block">{{ $category->name }}</h3>
                
                <div class="space-y-4">
                    @forelse ($category->products as $product)
                        @if ($product->is_available)
                            <div class="bg-white border-2 border-black p-3 shadow-retro-sm flex gap-3 relative group">
                                <div class="w-24 h-24 bg-gray-200 border-2 border-black flex-shrink-0">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/200x200.png?text=Menu' }}" 
                                         class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                                </div>
                                
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold uppercase leading-tight">{{ $product->name }}</h4>
                                        <p class="text-xs text-gray-500 line-clamp-2">{{ $product->description }}</p>
                                    </div>
                                    <div class="flex justify-between items-end mt-2">
                                        <div class="font-display text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                        
                                        <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-brand-black text-brand-yellow px-4 py-1.5 font-bold uppercase text-xs border-2 border-transparent hover:border-black hover:bg-brand-yellow hover:text-black transition-all active:scale-95 shadow-sm">
                                                TAMBAH +
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p class="text-center text-gray-400 font-bold border-2 border-dashed border-gray-300 py-4">Kategori Kosong</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </main>

    <div id="sticky-checkout-bar" class="fixed bottom-0 left-0 w-full z-50 bar-hidden">
        <div class="max-w-2xl mx-auto">
            <div class="bg-brand-black border-t-4 border-brand-yellow p-4 shadow-[0_-4px_10px_rgba(0,0,0,0.1)]">
                <div class="flex justify-between items-center gap-4">
                    <div class="text-white">
                        <p class="text-xs text-gray-400 font-bold uppercase mb-0.5">Total Estimasi</p>
                        <div class="flex items-baseline gap-2">
                            <span class="font-display text-xl text-brand-yellow" id="bar-total-price">Rp 0</span>
                            <span class="text-sm font-bold text-gray-400">(<span id="bar-total-items">0</span> Item)</span>
                        </div>
                    </div>

                    <button id="open-checkout-modal" class="flex-shrink-0 bg-brand-yellow text-black px-6 py-3 border-2 border-white font-display uppercase tracking-wider shadow-[4px_4px_0px_0px_#fff] hover:translate-y-1 hover:shadow-none transition-all">
                        Cek Pesanan &rarr;
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="cart-modal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" id="modal-backdrop"></div>
        
        <div class="absolute bottom-0 left-0 w-full h-[90vh] bg-white border-t-4 border-brand-black rounded-t-xl flex flex-col transform transition-transform duration-300 translate-y-full" id="modal-content">
            
            <div class="bg-gray-50 p-4 border-b-2 border-black flex justify-between items-center">
                <h2 class="font-display text-xl uppercase">Rincian Pesanan</h2>
                <button id="close-modal" class="p-2 hover:bg-gray-200 rounded-full transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div id="cart-items-container" class="flex-1 overflow-y-auto p-4 space-y-4 bg-white">
                </div>

            <div id="cart-summary" class="bg-gray-100 p-5 border-t-4 border-black space-y-4">
                </div>
        </div>
    </div>

    <div id="delete-confirmation-modal" class="fixed inset-0 bg-black/90 z-[70] hidden items-center justify-center p-4">
        <div class="bg-white border-4 border-black p-6 w-full max-w-sm text-center shadow-retro">
            <h3 class="font-display text-xl uppercase mb-2">Hapus Item?</h3>
            <p class="text-sm text-gray-600 mb-6">Kamu yakin mau menghapus <span id="delete-item-name" class="font-bold underline decoration-brand-yellow">...</span>?</p>
            <div class="flex gap-3">
                <button id="cancel-delete-btn" class="flex-1 py-2 border-2 border-black font-bold uppercase hover:bg-gray-100">Batal</button>
                <button id="confirm-delete-btn" class="flex-1 py-2 bg-red-600 text-white border-2 border-black font-bold uppercase shadow-retro-sm hover:shadow-none hover:translate-y-1">Hapus</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="fixed top-4 left-0 right-0 z-[80] flex justify-center pointer-events-none"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Elements
            const stickyBar = document.getElementById('sticky-checkout-bar');
            const cartModal = document.getElementById('cart-modal');
            const modalContent = document.getElementById('modal-content');
            const cartItemsContainer = document.getElementById('cart-items-container');
            const cartSummary = document.getElementById('cart-summary');
            
            // Helper Format Rupiah
            const formatRupiah = (num) => new Intl.NumberFormat('id-ID').format(num);

            // --- 1. Initial Load ---
            loadCartData();

            // --- 2. Logic Sticky Bar & Modal ---
            function updateStickyBar(data) {
                const totalItems = document.getElementById('bar-total-items');
                const totalPrice = document.getElementById('bar-total-price');
                
                totalItems.textContent = data.total_quantity;
                totalPrice.textContent = 'Rp ' + formatRupiah(data.grand_total); // Pakai grand_total biar real

                // Show/Hide Logic
                if (data.total_quantity > 0) {
                    stickyBar.classList.remove('bar-hidden');
                    stickyBar.classList.add('bar-visible');
                } else {
                    stickyBar.classList.add('bar-hidden');
                    stickyBar.classList.remove('bar-visible');
                    closeModal(); // Auto close modal if cart empty
                }
            }

            // Modal Controls
            document.getElementById('open-checkout-modal').addEventListener('click', () => {
                cartModal.classList.remove('hidden');
                // Small delay for animation
                setTimeout(() => {
                    modalContent.classList.remove('translate-y-full');
                }, 10);
                document.body.style.overflow = 'hidden';
            });

            function closeModal() {
                modalContent.classList.add('translate-y-full');
                setTimeout(() => {
                    cartModal.classList.add('hidden');
                }, 300);
                document.body.style.overflow = '';
            }

            document.getElementById('close-modal').addEventListener('click', closeModal);
            document.getElementById('modal-backdrop').addEventListener('click', closeModal);

            // --- 3. Cart Data Fetching & Rendering ---
            function loadCartData() {
                fetch('{{ route("cart.get") }}', { headers: { 'Accept': 'application/json' } })
                    .then(res => res.json())
                    .then(data => {
                        updateStickyBar(data);
                        renderCartItems(data);
                    })
                    .catch(err => console.error(err));
            }

            function renderCartItems(data) {
                if (data.items.length === 0) {
                    cartItemsContainer.innerHTML = '<div class="text-center py-10 text-gray-400">Keranjang Kosong</div>';
                    return;
                }

                let html = '';
                data.items.forEach(item => {
                    const img = item.image ? `{{ asset('storage/') }}/${item.image}` : 'https://via.placeholder.com/80x80';
                    html += `
                        <div class="flex gap-4 border-b border-gray-200 pb-4 last:border-0">
                            <img src="${img}" class="w-16 h-16 object-cover border-2 border-black rounded-sm">
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-bold text-sm uppercase leading-tight">${item.name}</h4>
                                    <button onclick="confirmDelete('${item.cart_id}', '${item.name.replace(/'/g, "\\'")}')" class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                                <div class="text-xs text-gray-500 mb-2">@ Rp ${formatRupiah(item.price)}</div>
                                
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center border-2 border-black bg-white h-8">
                                        <button onclick="updateQty('${item.cart_id}', ${item.quantity - 1})" class="w-8 h-full flex items-center justify-center hover:bg-gray-200 font-bold text-lg">-</button>
                                        <div class="w-8 h-full flex items-center justify-center font-bold text-sm border-x-2 border-black">${item.quantity}</div>
                                        <button onclick="updateQty('${item.cart_id}', ${item.quantity + 1})" class="w-8 h-full flex items-center justify-center hover:bg-gray-200 font-bold text-lg">+</button>
                                    </div>
                                    <div class="font-display text-base">Rp ${formatRupiah(item.subtotal)}</div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                cartItemsContainer.innerHTML = html;

                // Render Summary Section inside Modal
                cartSummary.innerHTML = `
                    <div class="space-y-1 text-sm text-gray-600 mb-4">
                        <div class="flex justify-between"><span>Subtotal</span><span class="font-bold">Rp ${formatRupiah(data.subtotal)}</span></div>
                        <div class="flex justify-between"><span>Layanan (${data.service_percent}%)</span><span>Rp ${formatRupiah(data.service_fee)}</span></div>
                        <div class="flex justify-between"><span>Pajak (${data.tax_percent}%)</span><span>Rp ${formatRupiah(data.tax)}</span></div>
                        <div class="flex justify-between text-black text-lg font-display pt-2 border-t border-black mt-2">
                            <span>TOTAL</span>
                            <span>Rp ${formatRupiah(data.grand_total)}</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <form action="{{ route('order.place.counter') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3 bg-white border-2 border-black font-bold uppercase hover:bg-gray-200 shadow-retro-sm active:shadow-none active:translate-y-1 transition-all">
                                Bayar Kasir
                            </button>
                        </form>
                        <button id="pay-online-btn" class="w-full py-3 bg-brand-black text-brand-yellow border-2 border-transparent hover:border-brand-yellow font-bold uppercase shadow-retro-sm active:shadow-none active:translate-y-1 transition-all">
                            QRIS / Online
                        </button>
                    </div>
                `;

                // Re-attach Online Payment Event
                document.getElementById('pay-online-btn')?.addEventListener('click', handleOnlinePayment);
            }

            // --- 4. Add to Cart (Toast Only, No Modal Open) ---
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const btn = this.querySelector('button');
                    const originalText = btn.innerText;
                    
                    // Button Loading State
                    btn.disabled = true;
                    btn.innerHTML = '<div class="loader w-4 h-4 border-black/20 border-l-black"></div>';

                    fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            showToast('Menu Ditambahkan!');
                            loadCartData(); // Refresh bottom bar
                        } else {
                            showToast(data.message || 'Gagal', 'error');
                        }
                    })
                    .finally(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
                });
            });

            // --- 5. Update Qty & Delete Logic ---
            window.updateQty = function(id, qty) {
                if(qty < 1) return confirmDelete(id, 'Item ini');
                
                fetch("{{ route('cart.update', ':id') }}".replace(':id', id), {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ quantity: qty })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) loadCartData();
                });
            };

            let deleteId = null;
            const deleteModal = document.getElementById('delete-confirmation-modal');

            window.confirmDelete = function(id, name) {
                deleteId = id;
                document.getElementById('delete-item-name').innerText = name;
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            };

            document.getElementById('cancel-delete-btn').onclick = () => { deleteModal.classList.remove('flex'); deleteModal.classList.add('hidden'); };
            
            document.getElementById('confirm-delete-btn').onclick = () => {
                fetch("{{ route('cart.remove', ':id') }}".replace(':id', deleteId), {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        deleteModal.classList.remove('flex');
                        deleteModal.classList.add('hidden');
                        loadCartData();
                        showToast('Item dihapus');
                    }
                });
            };

            // --- 6. Payment Handler ---
            function handleOnlinePayment() {
                 const btn = document.getElementById('pay-online-btn');
                 const originalText = btn.innerHTML;
                 btn.innerHTML = 'Memproses...';
                 btn.disabled = true;

                 fetch('{{ route("order.place.online") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                 })
                 .then(res => res.json())
                 .then(data => {
                    if(data.snapToken) {
                        // Close modal so user sees payment popup
                        closeModal();
                        window.snap.pay(data.snapToken, {
                            onSuccess: (res) => window.location.href = "{{ route('order.success', ':id') }}".replace(':id', data.orderId),
                            onPending: () => alert('Menunggu pembayaran...'),
                            onError: () => alert('Pembayaran gagal'),
                            onClose: () => { 
                                // Reopen modal if closed without paying
                                document.getElementById('open-checkout-modal').click();
                                btn.disabled = false; btn.innerHTML = originalText; 
                            }
                        });
                    } else {
                        alert(data.error || 'Error');
                        btn.disabled = false; btn.innerHTML = originalText;
                    }
                 })
                 .catch(() => { btn.disabled = false; btn.innerHTML = originalText; });
            }

            // Toast Function
            function showToast(msg, type = 'success') {
                const toast = document.createElement('div');
                const bg = type === 'success' ? 'bg-brand-black text-brand-yellow' : 'bg-red-600 text-white';
                toast.className = `${bg} px-6 py-3 font-bold uppercase border-2 border-white shadow-lg mb-2 mx-4 animate-slideIn transition-all duration-300 pointer-events-auto z-[90]`;
                toast.innerText = msg;
                document.getElementById('toast-container').appendChild(toast);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 300);
                }, 2000);
            }
        });
    </script>
</body>
</html>