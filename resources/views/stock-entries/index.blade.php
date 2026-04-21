@extends('layouts.app')

@section('title', 'Daftar Entri Stok')
@section('subtitle', 'Riwayat penambahan dan pengurangan stok')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Entri Stok</h1>
            <p class="text-gray-600">Riwayat penambahan dan pengurangan stok produk</p>
        </div>
        <a href="{{ route('stock-entries.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Entri Stok
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border p-4 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
                <select name="product_id" class="w-full border-gray-300 rounded-lg">
                    <option value="">Semua Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                <select name="type" class="w-full border-gray-300 rounded-lg">
                    <option value="">Semua Tipe</option>
                    <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Masuk</option>
                    <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Keluar</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" 
                       class="w-full border-gray-300 rounded-lg">
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 w-full">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('stock-entries.index') }}" 
                   class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuantitas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($stockEntries as $entry)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $entry->created_at->format('d/m/Y') }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $entry->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-box text-gray-500"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $entry->product->name ?? 'Produk tidak ditemukan' }}</div>
                                    <div class="text-sm text-gray-500">{{ $entry->product->sku ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($entry->type == 'in')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-arrow-down mr-1"></i> Masuk
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-arrow-up mr-1"></i> Keluar
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-bold {{ $entry->type == 'in' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $entry->type == 'in' ? '+' : '-' }}{{ number_format($entry->quantity) }}
                            </div>
                            <div class="text-sm text-gray-500">
                                Stok: {{ number_format($entry->product->current_stock ?? 0) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $entry->note ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('stock-entries.show', $entry) }}" 
                               class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('stock-entries.edit', $entry) }}" 
                               class="text-yellow-600 hover:text-yellow-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('stock-entries.destroy', $entry) }}" 
                                  method="POST" class="inline" 
                                  onsubmit="return confirm('Hapus entri stok ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-boxes text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg text-gray-500">Belum ada entri stok</p>
                                <p class="text-sm text-gray-400 mt-1">Mulai dengan menambahkan entri stok pertama</p>
                                <a href="{{ route('stock-entries.create') }}" 
                                   class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus mr-2"></i> Tambah Entri Stok
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($stockEntries->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">
            {{ $stockEntries->links() }}
        </div>
        @endif
    </div>

    <!-- Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="p-3 bg-green-50 rounded-lg mr-4">
                    <i class="fas fa-arrow-down text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Stok Masuk</p>
                    <p class="text-2xl font-bold text-green-600">{{ number_format($totalIn) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="p-3 bg-red-50 rounded-lg mr-4">
                    <i class="fas fa-arrow-up text-red-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Stok Keluar</p>
                    <p class="text-2xl font-bold text-red-600">{{ number_format($totalOut) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="p-3 bg-blue-50 rounded-lg mr-4">
                    <i class="fas fa-exchange-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Transaksi</p>
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($totalTransactions) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection