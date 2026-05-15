@extends('layouts.app')

@section('title', 'Laporan Penjualan - Faa Frozen')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Laporan Penjualan</h2>
            <p class="text-gray-500 mt-1">Data transaksi berdasarkan rentang waktu tertentu.</p>
        </div>
        
        <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm">
            <form method="GET" action="{{ url('/reports/sales') }}" class="flex flex-col md:flex-row items-end gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Mulai</label>
                    <input type="date" name="start_date" 
                           class="block w-full bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-indigo-500"
                           value="{{ $startDate instanceof \Carbon\Carbon ? $startDate->format('Y-m-d') : $startDate }}">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Sampai</label>
                    <input type="date" name="end_date" 
                           class="block w-full bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-indigo-500"
                           value="{{ $endDate instanceof \Carbon\Carbon ? $endDate->format('Y-m-d') : $endDate }}">
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl font-bold transition-all transform hover:-translate-y-1">
                    <i class="fas fa-filter mr-2 text-xs"></i> Filter
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mr-4">
                <i class="fas fa-money-bill-wave text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pendapatan</p>
                <p class="text-2xl font-black text-gray-900">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mr-4">
                <i class="fas fa-shopping-basket text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Item Terjual</p>
                <p class="text-2xl font-black text-gray-900">{{ number_format($totalItems, 0, ',', '.') }} <span class="text-sm font-medium text-gray-400">Unit</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                        <th class="px-6 py-5">No</th>
                        <th class="px-6 py-5">Tanggal</th>
                        <th class="px-6 py-5">Produk</th>
                        <th class="px-6 py-5 text-center">Qty</th>
                        <th class="px-6 py-5 text-right">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($sales as $index => $sale)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm font-bold text-gray-400">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900">{{ $sale->product->name ?? '-' }}</span>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-400">
                            <i class="fas fa-folder-open text-4xl mb-4 block opacity-20"></i>
                            Belum ada data penjualan pada rentang waktu ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection