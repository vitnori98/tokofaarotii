@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Data Penjualan</h2>
            <p class="text-gray-500 mt-1">Pantau semua transaksi masuk dari Frozen & Bakery.</p>
        </div>
        <a href="{{ route('sales.create') }}" 
           class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 transition-all transform hover:-translate-y-1">
            <i class="fas fa-cart-plus mr-2"></i> Tambah Transaksi
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mr-4">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pendapatan</p>
                <p class="text-2xl font-black text-gray-900">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mr-4">
                <i class="fas fa-box-open text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Item Terjual</p>
                <p class="text-2xl font-black text-gray-900">{{ $totalItems }} <span class="text-sm font-medium text-gray-400">Unit</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                        <th class="px-6 py-5">Tanggal & Pelanggan</th>
                        <th class="px-6 py-5">Produk</th>
                        <th class="px-6 py-5">Sumber</th>
                        <th class="px-6 py-5 text-center">Qty</th>
                        <th class="px-6 py-5 text-right">Total Harga</th>
                        <th class="px-6 py-5 text-center">Status & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($sales as $sale)
                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900 block">{{ $sale->created_at->format('d M Y') }}</span>
                            <span class="text-[10px] text-indigo-500 font-black uppercase customer-name">{{ $sale->customer_name ?? 'Umum' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3 text-gray-400">
                                    <i class="fas fa-tag text-[10px]"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-700 product-name">{{ $sale->product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if(($sale->source ?? 'offline') == 'online')
                                <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-wider italic">
                                    <i class="fas fa-globe mr-1"></i> Online
                                </span>
                            @else
                                <span class="px-2 py-1 bg-gray-50 text-gray-600 rounded-lg text-[10px] font-black uppercase tracking-wider italic">
                                    <i class="fas fa-store mr-1"></i> Toko
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-xs font-black text-gray-600 sale-qty">
                                {{ $sale->quantity_sold }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-black text-indigo-600 sale-total">
                                Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Status/Konfirmasi --}}
                                @if(($sale->status ?? 'completed') == 'pending')
                                    <form action="{{ route('sales.confirm', $sale->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" title="Konfirmasi" 
                                            class="w-8 h-8 flex items-center justify-center bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition-all shadow-sm">
                                            <i class="fas fa-check text-[10px]"></i>
                                        </button>
                                    </form>
                                @else
                                    <div title="Selesai" class="w-8 h-8 flex items-center justify-center bg-green-50 text-green-500 rounded-lg">
                                        <i class="fas fa-check-circle text-xs"></i>
                                    </div>
                                @endif

                                {{-- Cetak Struk --}}
                                <button onclick="reprintStruk({{ $sale->id }})" title="Cetak Ulang"
                                    class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white rounded-lg transition-all border border-blue-100">
                                    <i class="fas fa-print text-xs"></i>
                                </button>

                                {{-- Hapus --}}
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus"
                                        class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all border border-red-100">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">Belum ada data penjualan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($sales->hasPages())
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50">
            {{ $sales->links() }}
        </div>
        @endif
    </div>
</div>

<script>
function reprintStruk(id) {
    const row = event.target.closest('tr');
    const tanggal = row.cells[0].querySelector('span.text-sm').innerText;
    const pelanggan = row.querySelector('.customer-name').innerText;
    const produk = row.querySelector('.product-name').innerText;
    const qty = row.querySelector('.sale-qty').innerText;
    const total = row.querySelector('.sale-total').innerText;

    let strukWindow = window.open('', '', 'width=400,height=600');
    
    strukWindow.document.write(`
        <html>
        <body style="font-family: 'Courier New', Courier, monospace; width: 300px; padding: 10px;">
            <div style="text-align: center; border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                <h2 style="margin: 0; font-size: 18px;">TOKO FAA</h2>
                <p style="margin: 0; font-size: 10px;">Frozen Food & Bakery</p>
                <p style="margin: 0; font-size: 10px;">(COPY STRUK)</p>
            </div>
            <div style="font-size: 11px; margin-bottom: 10px;">
                <div>Tgl: ${tanggal}</div>
                <div>Pelanggan: ${pelanggan}</div>
            </div>
            <div style="border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px;">
                <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 5px;">
                    <span>${qty}x ${produk}</span>
                    <span>${total}</span>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 14px; margin-bottom: 10px;">
                <span>TOTAL</span>
                <span>${total}</span>
            </div>
            <div style="text-align: center; font-size: 10px; margin-top: 20px;">
                *** Terima Kasih ***<br>Cetakan Ulang
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
</script>
@endsection