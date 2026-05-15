@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6">
    <!-- Header Section -->
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

    <!-- Ringkasan Statistik -->
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

    <!-- Tabel Riwayat -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                        <th class="px-6 py-5">Tanggal & Pelanggan</th>
                        <th class="px-6 py-5">Produk</th>
                        <th class="px-6 py-5 text-center">Qty</th>
                        <th class="px-6 py-5 text-right">Total Harga</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($sales as $sale)
                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900 block">{{ $sale->created_at->format('d M Y') }}</span>
                            <span class="text-[10px] text-indigo-500 font-black uppercase">{{ $sale->customer_name ?? 'Umum' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3 text-gray-400">
                                    <i class="fas fa-tag text-[10px]"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">{{ $sale->product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-xs font-black text-gray-600">
                                {{ $sale->quantity_sold }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-black text-indigo-600">
                                Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition-colors">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <i class="fas fa-receipt text-6xl mb-4"></i>
                                <p class="text-lg font-bold italic">Belum ada transaksi tercatat</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50">
            {{ $sales->links() }}
        </div>
    </div>
</div>
@endsection