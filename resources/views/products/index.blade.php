@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('subtitle', 'Kelola data produk inventori')

@section('content')
<div class="bg-white rounded-xl shadow-sm border">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-semibold">Daftar Produk</h2>
    
    <!-- FORM PENCARIAN & FILTER -->
    <form action="{{ route('products.index') }}" method="GET" class="flex gap-2">
        
        <!-- Filter Kategori -->
        <select name="category_id" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <!-- Input Cari -->
        <div class="relative">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari produk atau SKU..." 
                   class="border rounded-lg pl-10 pr-4 py-2 w-64 focus:ring-2 focus:ring-indigo-500">
            <div class="absolute left-3 top-2.5 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <button type="submit" class="hidden">Cari</button>
    </form>

    <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
        + Tambah Produk
    </a>
    </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="m-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Gambar
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Produk
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kategori
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Harga
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Stok
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $index => $product)
                <tr class="hover:bg-gray-50">
                    <!-- NO -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        {{ $products->firstItem() + $index }}
                    </td>

                    <!-- IMAGE -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->image)
                            <div class="h-12 w-12 rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="h-12 w-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                        @endif
                    </td>

                    <!-- NAME -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div>
                                <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500 mt-1">
                                    {{ Str::limit($product->description, 50) }}
                                </div>
                                @if($product->sku)
                                    <div class="text-xs text-gray-400 mt-1">
                                        SKU: {{ $product->sku }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- CATEGORY -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->category)
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                {{ $product->category->name }}
                            </span>
                        @else
                            <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>

                    <!-- PRICE -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </td>

                    <!-- STOCK CALCULATION -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $totalStock = $product->stockEntries->sum('quantity');
                            $totalSold = $product->sales->sum('quantity_sold');
                            $currentStock = $totalStock - $totalSold;
                        @endphp
                        
                        <div class="flex items-center">
                            <span class="text-sm font-medium text-gray-900 mr-3">{{ $currentStock }}</span>
                            @if($currentStock <= 0)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Habis
                                </span>
                            @elseif($currentStock < 10)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Rendah
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Aman
                                </span>
                            @endif
                        </div>
                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <!-- View Button -->
                            <a href="{{ route('products.show', $product->id) }}"
                               class="text-blue-600 hover:text-blue-900"
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="text-indigo-600 hover:text-indigo-900"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('products.destroy', $product->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center text-gray-500">
                            <i class="fas fa-box-open text-4xl mb-4"></i>
                            <p class="text-lg font-medium mb-2">Belum ada produk</p>
                            <p class="text-sm mb-4">Mulai dengan menambahkan produk pertama Anda</p>
                            <a href="{{ route('products.create') }}"
                               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Produk Pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="px-6 py-4 border-t bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
            </div>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Produk</p>
                <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
            </div>
            <div class="p-3 rounded-lg bg-blue-50">
                <i class="fas fa-box text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Kategori</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Category::count() }}</p>
            </div>
            <div class="p-3 rounded-lg bg-green-50">
                <i class="fas fa-tags text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Stok Rendah</p>
                @php
                    $lowStockCount = 0;
                    foreach($products as $product) {
                        $totalStock = $product->stockEntries->sum('quantity');
                        $totalSold = $product->sales->sum('quantity_sold');
                        $currentStock = $totalStock - $totalSold;
                        if($currentStock < 10 && $currentStock > 0) {
                            $lowStockCount++;
                        }
                    }
                @endphp
                <p class="text-2xl font-bold text-gray-900">{{ $lowStockCount }}</p>
            </div>
            <div class="p-3 rounded-lg bg-yellow-50">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>
@endsection