@extends('layouts.app')

@section('title', 'Laporan Stok - Faa Frozen')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Laporan Inventaris</h2>
        <p class="text-gray-500 mt-1">Pantau ketersediaan stok produk Frozen & Bakery secara real-time.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mr-4">
                <i class="fas fa-boxes text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Produk</p>
                <p class="text-2xl font-black text-gray-900">{{ $products->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mr-4">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Stok Menipis</p>
                <p class="text-2xl font-black text-gray-900">{{ $lowStock->count() }} <span class="text-sm font-medium text-gray-400">Item</span></p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 mr-4">
                <i class="fas fa-times-circle text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Stok Habis</p>
                <p class="text-2xl font-black text-gray-900">{{ $outOfStock->count() }} <span class="text-sm font-medium text-gray-400">Item</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center">
            <h5 class="font-black text-gray-800 uppercase tracking-wider text-sm">Status Stok Semua Produk</h5>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                        <th class="px-6 py-5">Produk</th>
                        <th class="px-6 py-5">Kategori</th>
                        <th class="px-6 py-5 text-center">Masuk</th>
                        <th class="px-6 py-5 text-center">Terjual</th>
                        <th class="px-6 py-5 text-center">Sisa Stok</th>
                        <th class="px-6 py-5 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900 block">{{ $product->name }}</span>
                            <span class="text-[10px] text-gray-400 font-medium tracking-tight">SKU: {{ $product->sku ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-semibold text-gray-600">{{ $product->category->name ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-medium text-gray-500">{{ $product->stockEntries->sum('quantity') }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-medium text-gray-500">{{ $product->sales->sum('quantity_sold') }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-black {{ $product->total_stok < 10 ? 'text-amber-500' : 'text-gray-900' }}">
                                {{ $product->total_stok }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($product->total_stok <= 0)
                                <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Habis</span>
                            @elseif($product->total_stok < 10)
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Menipis</span>
                            @else
                                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic text-sm">
                            Belum ada data produk yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection