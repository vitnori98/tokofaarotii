@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Overview sistem manajemen inventori')

@section('content')
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Products Card -->
        <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Products</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalProducts) }}</p>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <i class="fas fa-tags mr-2"></i>
                        <span>{{ $totalCategories }} kategori</span>
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-blue-50">
                    <i class="fas fa-box text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Stock Card -->
        <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Stock</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($totalStock) }}</p>
                    <div class="mt-2">
                        @php
                            $lowStockCount = ($lowStock->count() ?? 0) + ($outOfStock->count() ?? 0);
                        @endphp
                        @if($lowStockCount > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $lowStockCount }} produk stok rendah
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Semua stok aman
                            </span>
                        @endif
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-green-50">
                    <i class="fas fa-warehouse text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Sales Card -->
        <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Penjualan</p>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        <span>{{ number_format($totalItemSold) }} item terjual</span>
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-purple-50">
                    <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Average Monthly Sales Card -->
        <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Rata-rata/Bulan</p>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($averageMonthlySales ?? 0, 0, ',', '.') }}</p>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <i class="fas fa-chart-bar mr-2"></i>
                        <span>Berdasarkan 12 bulan terakhir</span>
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-yellow-50">
                    <i class="fas fa-calendar-alt text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Monthly Sales Chart -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Penjualan 6 Bulan Terakhir</h2>
                    <p class="text-sm text-gray-500">Total Penjualan</p>
                </div>
                <button onclick="exportMonthlySales()" 
                        class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
            </div>
            <div class="h-72">
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>

        <!-- Sales by Category Chart -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Penjualan per Kategori</h2>
                    <p class="text-sm text-gray-500">Total Pendapatan</p>
                </div>
                <span class="text-sm text-gray-500">{{ $topCategories->count() ?? 0 }} kategori</span>
            </div>
            <div class="h-72">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Top Products Table -->
        <div class="bg-white rounded-xl shadow-sm border">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Produk Terlaris</h2>
                <p class="text-sm text-gray-500">Top 5 produk berdasarkan jumlah penjualan</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRODUK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TERJUAL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PERINGKAT</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($topProducts as $index => $sale)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-box text-gray-500"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $sale->product->name ?? 'Produk tidak ditemukan' }}</p>
                                        <p class="text-sm text-gray-500">{{ $sale->product->category->name ?? 'Tidak ada kategori' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ number_format($sale->total_sold) }} unit
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @switch($index)
                                        @case(0)
                                            <div class="h-8 w-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-crown text-yellow-600"></i>
                                            </div>
                                            <span class="ml-2 font-medium">#1</span>
                                            @break
                                        @case(1)
                                            <div class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-medal text-gray-500"></i>
                                            </div>
                                            <span class="ml-2 font-medium">#2</span>
                                            @break
                                        @case(2)
                                            <div class="h-8 w-8 bg-orange-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-medal text-orange-500"></i>
                                            </div>
                                            <span class="ml-2 font-medium">#3</span>
                                            @break
                                        @default
                                            <div class="h-8 w-8 bg-gray-50 rounded-full flex items-center justify-center">
                                                <span class="font-medium">#{{ $index + 1 }}</span>
                                            </div>
                                    @endswitch
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-chart-bar text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg">Belum ada data penjualan</p>
                                    <p class="text-sm mt-1">Mulai catat penjualan untuk melihat data</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Low Stock Table -->
        <div class="bg-white rounded-xl shadow-sm border">
            <div class="px-6 py-4 border-b">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Stok Perlu Perhatian</h2>
                        <p class="text-sm text-gray-500">Produk dengan stok menipis atau habis</p>
                    </div>
                    @php
                        $alertCount = ($lowStock->count() ?? 0) + ($outOfStock->count() ?? 0);
                    @endphp
                    @if($alertCount > 0)
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                        {{ $alertCount }} produk
                    </span>
                    @endif
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRODUK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STOK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Out of Stock -->
                        @forelse($outOfStock ?? [] as $product)
                        <tr class="hover:bg-red-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-box-open text-red-500"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $product->sku ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-red-600">0</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Habis
                                </span>
                            </td>
                        </tr>
                        @endforeach

                        <!-- Low Stock -->
                        @forelse($lowStock ?? [] as $product)
                        <tr class="hover:bg-yellow-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-box text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $product->sku ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="font-bold text-yellow-600 mr-3">{{ $product->current_stock ?? 0 }}</span>
                                    <div class="w-24 bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ min(($product->current_stock / 10) * 100, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Menipis
                                </span>
                            </td>
                        </tr>
                        @endforeach

                        @if(($lowStock->isEmpty() ?? true) && ($outOfStock->isEmpty() ?? true))
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-check-circle text-4xl text-green-500 mb-4"></i>
                                    <p class="text-lg">Semua stok dalam kondisi aman</p>
                                    <p class="text-sm mt-1">Tidak ada produk dengan stok rendah</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('products.create') }}" 
           class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-300 text-center group">
            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200">
                <i class="fas fa-plus text-blue-600 text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Tambah Produk Baru</h3>
            <p class="text-sm text-gray-500">Tambahkan produk baru ke inventori</p>
        </a>
        
        <a href="{{ route('sales.create') }}" 
           class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-300 text-center group">
            <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200">
                <i class="fas fa-cart-plus text-green-600 text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Catat Penjualan</h3>
            <p class="text-sm text-gray-500">Catat transaksi penjualan baru</p>
        </a>
        
        <!-- stock-entries -->
    <a href="{{ route('stock-entries.create') }}" 
       class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow duration-300 text-center group">
        <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200">
            <i class="fas fa-boxes text-purple-600 text-xl"></i>
        </div>
        <h3 class="font-semibold text-gray-900 mb-2">Update Stok</h3>
        <p class="text-sm text-gray-500">Tambah atau kurangi stok produk</p>
    </a>
</div>
@endsection

@push('scripts')
<script>
// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Sales Chart
    const monthlyCtx = document.getElementById('monthlySalesChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Total Penjualan',
                    data: @json($chartData ?? []),
                    borderColor: 'rgb(79, 70, 229)',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(79, 70, 229)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart');
    if (categoryCtx && @json($categoryData ?? []).length > 0) {
        new Chart(categoryCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($categoryLabels ?? []),
                datasets: [{
                    data: @json($categoryData ?? []),
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.9)',
                        'rgba(59, 130, 246, 0.9)',
                        'rgba(16, 185, 129, 0.9)',
                        'rgba(245, 158, 11, 0.9)',
                        'rgba(239, 68, 68, 0.9)',
                        'rgba(139, 92, 246, 0.9)',
                        'rgba(20, 184, 166, 0.9)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': Rp ' + context.parsed.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    } else if (categoryCtx) {
        // Show message if no data
        categoryCtx.parentElement.innerHTML = `
            <div class="h-full flex flex-col items-center justify-center text-gray-500">
                <i class="fas fa-chart-pie text-4xl mb-4"></i>
                <p>Belum ada data penjualan per kategori</p>
            </div>
        `;
    }
});

// Export function
function exportMonthlySales() {
    alert('Fitur export akan tersedia segera!');
    // Implement export functionality here
}
</script>
@endpush