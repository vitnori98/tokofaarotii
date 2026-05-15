@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->name)

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 pb-12">
    <!-- Header & Breadcrumb -->
    <div class="mb-8">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 text-sm text-gray-400">
                <li>
                    <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Produk
                    </a>
                </li>
                <li><svg class="w-3 h-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                <li class="text-gray-900 font-semibold italic">Detail Item</li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-[10px] font-bold rounded-full uppercase tracking-widest mb-2 inline-block">
                    {{ $product->category->name ?? 'Uncategorized' }}
                </span>
                <h2 class="text-4xl font-black text-gray-900 tracking-tight italic">{{ $product->name }}</h2>
                <p class="text-gray-500 mt-1 font-medium flex items-center">
                    <span class="mr-3">SKU: <span class="font-mono text-indigo-600">{{ $product->sku ?? 'N/A' }}</span></span>
                    <span class="w-1.5 h-1.5 bg-gray-300 rounded-full mr-3"></span>
                    <span>Ditambahkan {{ $product->created_at->format('d M Y') }}</span>
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('products.edit', $product->id) }}" 
                   class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 rounded-2xl font-bold text-gray-700 hover:bg-gray-50 hover:border-indigo-300 hover:text-indigo-600 transition-all shadow-sm">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini secara permanen?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-red-50 border border-red-100 rounded-2xl font-bold text-red-600 hover:bg-red-100 transition-all shadow-sm">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Visual Card -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-4 relative overflow-hidden group">
                <div class="aspect-square bg-gray-50 rounded-[1.5rem] flex items-center justify-center overflow-hidden border border-gray-100">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="text-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-box text-gray-200 text-8xl mb-4"></i>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">No Preview Available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Enhanced Stock Card -->
            <div class="bg-gray-900 rounded-[2rem] shadow-2xl p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">Real-time Inventory</h3>
                        <i class="fas fa-cube text-indigo-500"></i>
                    </div>
                    
                    @php
                        $currentStock = $product->stockEntries->sum('quantity') - $product->sales->sum('quantity_sold');
                    @endphp

                    <div class="flex items-baseline gap-2 mb-2">
                        <span class="text-6xl font-black tracking-tighter">{{ $currentStock }}</span>
                        <span class="text-indigo-400 font-bold uppercase text-sm">{{ $product->unit ?? 'pcs' }}</span>
                    </div>

                    <div class="mb-8">
                        @if($currentStock <= 0)
                            <div class="inline-flex items-center px-3 py-1 bg-red-500/10 border border-red-500/20 text-red-400 text-[10px] font-black rounded-full">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2 animate-pulse"></span> OUT OF STOCK
                            </div>
                        @elseif($currentStock < 10)
                            <div class="inline-flex items-center px-3 py-1 bg-orange-500/10 border border-orange-500/20 text-orange-400 text-[10px] font-black rounded-full">
                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-2 animate-pulse"></span> LOW STOCK
                            </div>
                        @else
                            <div class="inline-flex items-center px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-black rounded-full">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2"></span> IN STOCK
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('stock-entries.create', ['product_id' => $product->id]) }}" 
                       class="flex items-center justify-center w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-black text-sm transition-all shadow-lg shadow-indigo-900/20 group">
                        <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform"></i> ISI ULANG STOK
                    </a>
                </div>
                <!-- Abstract BG -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-indigo-600/10 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Content -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-6">
                    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 text-2xl shadow-inner">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Harga Jual</p>
                        <h4 class="text-3xl font-black text-gray-900 leading-none">
                            <span class="text-sm font-bold text-gray-400 mr-1">Rp</span>{{ number_format($product->price, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-6">
                    <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-600 text-2xl shadow-inner">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Satuan</p>
                        <h4 class="text-3xl font-black text-gray-900 leading-none">{{ $product->unit ?? 'Pcs' }}</h4>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-sm">
                <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white text-xs mr-4 shadow-lg shadow-indigo-200">
                        <i class="fas fa-align-left"></i>
                    </span>
                    Deskripsi Produk
                </h3>
                <p class="text-gray-600 leading-relaxed font-medium italic italic">
                    {{ $product->description ?: 'Product owner belum memberikan deskripsi detail mengenai item ini.' }}
                </p>
            </div>

            <!-- History Section -->
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="font-black text-gray-900 tracking-tight italic">
                        <i class="fas fa-history mr-2 text-indigo-600"></i> Log Aktivitas Stok
                    </h3>
                    <span class="text-[10px] font-bold text-gray-400 uppercase">5 Transaksi Terakhir</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Detail</th>
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Qty</th>
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Balance</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @php 
                                $runningBalance = $currentStock; 
                                $entries = $product->stockEntries()->latest()->take(5)->get();
                            @endphp
                            @forelse($entries as $entry)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $entry->type == 'in' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                                            <i class="fas {{ $entry->type == 'in' ? 'fa-arrow-down' : 'fa-arrow-up' }} text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ $entry->type == 'in' ? 'Barang Masuk' : 'Barang Keluar' }}</p>
                                            <p class="text-[10px] font-medium text-gray-400">{{ $entry->created_at->format('d M, H:i') }} WIB</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="text-sm font-black {{ $entry->type == 'in' ? 'text-emerald-600' : 'text-red-600' }}">
                                        {{ $entry->type == 'in' ? '+' : '-' }}{{ $entry->quantity }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right font-mono text-sm font-bold text-gray-900">
                                    {{ number_format($runningBalance, 0) }}
                                    @php 
                                        // Update balance for next row (reverse math since we show latest first)
                                        $runningBalance += ($entry->type == 'in' ? -$entry->quantity : $entry->quantity); 
                                    @endphp
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-16 text-center">
                                    <i class="fas fa-stream text-gray-200 text-3xl mb-4"></i>
                                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Belum ada riwayat stok</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection