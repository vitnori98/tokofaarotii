@extends('layouts.app')

@section('title', 'Kasir Modern - Faa Frozen')

@section('content')
<div class="max-w-[1600px] mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <div class="lg:col-span-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-black text-gray-800">KATALOG PRODUK</h2>
                <div class="relative w-64">
                    <input type="text" id="searchInput" onkeyup="filterProducts()" placeholder="Cari produk..." 
                           class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm">
                    <i class="fas fa-search absolute left-4 top-3 text-gray-400 text-xs"></i>
                </div>
            </div>

            <div id="productGrid" class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 overflow-y-auto max-h-[700px] pr-2 custom-scrollbar">
                @foreach($products as $product)
                <div onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})" 
                     class="product-card bg-white p-3 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-indigo-400 cursor-pointer transition-all group relative overflow-hidden">
                    
                    <div class="aspect-square bg-gray-50 rounded-xl mb-3 overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-200">
                                <i class="fas fa-bread-slice text-3xl"></i>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="product-name text-sm font-bold text-gray-800 truncate mb-1">{{ $product->name }}</h3>
                    <p class="text-indigo-600 font-black text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-4">
            <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 flex flex-col h-[750px] overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-50 rounded-full flex items-center justify-center text-indigo-600">
                            <i class="fas fa-user text-xs"></i>
                        </div>
                        <input type="text" id="customer_name" placeholder="Nama Pelanggan (Umum)" 
                               class="flex-1 bg-transparent border-none focus:ring-0 font-bold text-gray-700">
                    </div>
                </div>

                <div id="cartItems" class="flex-1 overflow-y-auto p-6 space-y-4 custom-scrollbar">
                    <div class="text-center text-gray-300 mt-10">Keranjang Kosong</div>
                </div>

                <div class="p-8 bg-gray-50">
                    <div class="flex justify-between items-end mb-6 text-left">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase mb-1">Total Pembayaran</p>
                            <div class="flex items-baseline text-indigo-600">
                                <span class="text-lg font-bold mr-1">Rp</span>
                                <span id="grandTotalDisplay" class="text-4xl font-black tracking-tighter">0</span>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="selesaikanOrder()" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black text-lg transition-all transform hover:-translate-y-1">
                        <i class="fas fa-check-circle mr-2"></i> SELESAIKAN ORDER
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];

    // 1. Tambah Produk ke Keranjang
    function addToCart(id, name, price) {
        const existing = cart.find(item => item.id === id);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ id, name, price, qty: 1 });
        }
        renderCart();
    }

    // 2. Ubah Jumlah (Tambah/Kurang)
    function changeQty(id, delta) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.qty += delta;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.id !== id);
            }
            renderCart();
        }
    }

    // 3. Update Tampilan Keranjang
    function renderCart() {
        const container = document.getElementById('cartItems');
        const display = document.getElementById('grandTotalDisplay');
        
        if (cart.length === 0) {
            container.innerHTML = `<div class="text-center text-gray-300 mt-10">Keranjang Kosong</div>`;
            display.innerText = "0";
            return;
        }

        let total = 0;
        container.innerHTML = cart.map(item => {
            total += (item.price * item.qty);
            return `
                <div class="flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-50 shadow-sm">
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">${item.name}</h4>
                        <p class="text-[10px] text-indigo-500 font-black">Rp ${item.price.toLocaleString('id-ID')}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="changeQty(${item.id}, -1)" class="w-7 h-7 bg-gray-100 rounded-lg text-gray-500 hover:bg-red-50 hover:text-red-600 transition-colors">
                            <i class="fas fa-minus text-[10px]"></i>
                        </button>
                        <span class="font-black text-sm text-gray-700 w-4 text-center">${item.qty}</span>
                        <button onclick="changeQty(${item.id}, 1)" class="w-7 h-7 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors">
                            <i class="fas fa-plus text-[10px]"></i>
                        </button>
                    </div>
                </div>`;
        }).join('');
        display.innerText = total.toLocaleString('id-ID');
    }

    // 4. Fitur Pencarian Produk
    function filterProducts() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('.product-card').forEach(card => {
            const name = card.querySelector('.product-name').innerText.toLowerCase();
            card.style.display = name.includes(query) ? "block" : "none";
        });
    }

    // 5. Fungsi Cetak Struk
    function printStruk(data, items) {
        let strukWindow = window.open('', '', 'width=400,height=600');
        let itemHtml = items.map(item => `
            <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 5px;">
                <span>${item.qty}x ${item.name}</span>
                <span>Rp ${(item.price * item.qty).toLocaleString('id-ID')}</span>
            </div>
        `).join('');

        let total = items.reduce((sum, item) => sum + (item.price * item.qty), 0);

        strukWindow.document.write(`
            <html>
            <body style="font-family: 'Courier New', Courier, monospace; width: 300px; padding: 10px;">
                <div style="text-align: center; border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                    <h2 style="margin: 0; font-size: 18px;">TOKO FAA</h2>
                    <p style="margin: 0; font-size: 10px;">Frozen Food & Bakery</p>
                </div>
                <div style="font-size: 11px; margin-bottom: 10px;">
                    <div>Tgl: ${data.time}</div>
                    <div>Pelanggan: ${data.customer}</div>
                </div>
                <div style="border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px;">
                    ${itemHtml}
                </div>
                <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 14px; margin-bottom: 10px;">
                    <span>TOTAL</span>
                    <span>Rp ${total.toLocaleString('id-ID')}</span>
                </div>
                <div style="text-align: center; font-size: 10px; margin-top: 20px;">
                    *** Terima Kasih ***<br>Selamat Menikmati!
                </div>
            </body>
            </html>
        `);

        strukWindow.document.close();
        setTimeout(() => {
            strukWindow.print();
            strukWindow.close();
        }, 500);
    }

    // 6. Selesaikan Transaksi (Simpan ke DB & Cetak)
    function selesaikanOrder() {
        if (cart.length === 0) return alert('Pilih produk dulu!');

        const customerName = document.getElementById('customer_name').value || 'Umum';

        fetch("{{ route('sales.pos.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                items: cart,
                customer_name: customerName
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Konfirmasi Cetak Struk
                if (confirm('Transaksi Berhasil! Apakah ingin cetak struk?')) {
                    printStruk(data, cart);
                }
                // Redirect ke halaman riwayat
                window.location.href = "{{ route('sales.index') }}";
            } else {
                alert('Gagal menyimpan transaksi: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan koneksi ke server.');
        });
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>
@endsection