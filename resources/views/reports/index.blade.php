@extends('layouts.app')

@section('title', 'Laporan Bisnis - Faa Frozen')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Laporan Analitik</h2>
        <p class="text-gray-500 mt-1">Ringkasan performa penjualan dan pergerakan stok Toko Faa.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mr-4">
                <i class="fas fa-coins text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pendapatan</p>
                <p class="text-2xl font-black text-gray-900">Rp {{ number_format($totalSales ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mr-4">
                <i class="fas fa-arrow-down text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Stok Masuk</p>
                <p class="text-2xl font-black text-gray-900">{{ number_format($totalStockIn ?? 0, 0, ',', '.') }} <span class="text-sm font-medium text-gray-400">Unit</span></p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 mr-4">
                <i class="fas fa-arrow-up text-xl"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Stok Keluar</p>
                <p class="text-2xl font-black text-gray-900">{{ number_format($totalStockOut ?? 0, 0, ',', '.') }} <span class="text-sm font-medium text-gray-400">Unit</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 text-center py-16">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                <i class="fas fa-chart-line text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">Detail Laporan Segera Hadir</h3>
            <p class="text-gray-500 max-w-xs mx-auto mt-2">Gunakan menu Penjualan dan Stok untuk melihat rincian transaksi harian saat ini.</p>
        </div>
    </div>
</div>
@endsection