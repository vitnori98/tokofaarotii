@extends('layouts.app')

@section('title', 'Panel Kendali')
@section('subtitle', 'Pusat kendali Toko Faa Frozen & Bakery')

@section('content')

{{-- ── WELCOME BANNER ── --}}
<div class="welcome-banner">
    <div class="welcome-content">
        <h2 class="welcome-title">Halo, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
        <p class="welcome-text">Selamat datang kembali di panel manajemen. Hari ini ada <strong>{{ $totalTransactions }}</strong> transaksi tercatat.</p>
    </div>
    <div class="welcome-actions">
        <a href="{{ route('sales.create') }}" class="btn-welcome">
            <i class="fas fa-cart-plus"></i> Kasir Baru
        </a>
    </div>
</div>

{{-- ── QUICK STATS ── --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-blue"><i class="fas fa-wallet"></i></div>
        <div class="stat-info">
            <span class="stat-label">Pendapatan Hari Ini</span>
            <span class="stat-value">Rp {{ number_format($todaySales, 0, ',', '.') }}</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-green"><i class="fas fa-shopping-basket"></i></div>
        <div class="stat-info">
            <span class="stat-label">Item Terjual</span>
            <span class="stat-value">{{ number_format($totalItemSold) }} <small>Unit</small></span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-orange"><i class="fas fa-boxes"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Stok</span>
            <span class="stat-value">{{ number_format($totalStock) }} <small>Item</small></span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-purple"><i class="fas fa-box"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Produk</span>
            <span class="stat-value">{{ number_format($totalProducts) }}</span>
        </div>
    </div>
</div>

<div class="dashboard-main-grid">
    
    {{-- ── LEFT COLUMN: CHARTS & TOP PRODUCTS ── --}}
    <div class="dashboard-col">
        
        {{-- Penjualan Chart --}}
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line text-orange-500"></i> Tren Penjualan</h3>
                <span class="card-subtitle">6 Bulan Terakhir</span>
            </div>
            <div class="card-body chart-container">
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>

        {{-- Categories Performance --}}
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie text-blue-500"></i> Performa Kategori</h3>
            </div>
            <div class="card-body">
                <div class="chart-mini">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-crown text-amber-500"></i> Produk Terlaris</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-wrap">
                    <table class="simple-table">
                        <thead>
                            <tr>
                                <th>PRODUK</th>
                                <th style="text-align:center;">TERJUAL</th>
                                <th style="text-align:right;">RANK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topProducts as $index => $item)
                            <tr>
                                <td>
                                    <div class="td-product">
                                        <span class="p-name">{{ $item->product->name ?? 'N/A' }}</span>
                                        <span class="p-cat">{{ $item->product->category->name ?? 'Umum' }}</span>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge-qty">{{ number_format($item->total_sold) }}</span>
                                </td>
                                <td style="text-align:right;">
                                    @if($index == 0) <i class="fas fa-trophy text-amber-400"></i> @else #{{ $index + 1 }} @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center py-4 text-gray-400">Belum ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ── RIGHT COLUMN: ALERTS & CATEGORIES ── --}}
    <div class="dashboard-col">
        
        {{-- Quick Shortcuts --}}
        <div class="shortcut-grid">
            <a href="{{ route('products.index') }}" class="shortcut-item">
                <i class="fas fa-box"></i>
                <span>Produk</span>
            </a>
            <a href="{{ route('stock-entries.index') }}" class="shortcut-item">
                <i class="fas fa-warehouse"></i>
                <span>Stok</span>
            </a>
            <a href="{{ route('reports.index') }}" class="shortcut-item">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Laporan</span>
            </a>
        </div>

        {{-- Stok Alerts --}}
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bell text-red-500"></i> Stok Perlu Perhatian</h3>
                <span class="badge-count {{ ($lowStock->count() + $outOfStock->count()) > 0 ? 'bg-red' : 'bg-green' }}">
                    {{ $lowStock->count() + $outOfStock->count() }}
                </span>
            </div>
            <div class="card-body p-0 max-h-80 overflow-y-auto custom-scrollbar">
                @forelse($outOfStock as $item)
                <div class="alert-item item-red">
                    <div class="alert-icon"><i class="fas fa-times-circle"></i></div>
                    <div class="alert-info">
                        <p class="alert-name">{{ $item->name }}</p>
                        <p class="alert-status">Stok Habis (0)</p>
                    </div>
                    <a href="{{ route('stock-entries.create', ['product_id' => $item->id]) }}" class="btn-refill">Isi</a>
                </div>
                @empty @endforelse

                @forelse($lowStock as $item)
                <div class="alert-item item-amber">
                    <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="alert-info">
                        <p class="alert-name">{{ $item->name }}</p>
                        <p class="alert-status">Stok Menipis ({{ $item->total_stok }})</p>
                    </div>
                    <a href="{{ route('stock-entries.create', ['product_id' => $item->id]) }}" class="btn-refill">Isi</a>
                </div>
                @empty @endforelse

                @if($lowStock->isEmpty() && $outOfStock->isEmpty())
                <div class="empty-alert">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <p>Semua stok aman</p>
                </div>
                @endif
            </div>
        </div>

    </div>

</div>

<style>
    /* ── Welcome Banner ── */
    .welcome-banner { background: linear-gradient(135deg, #f97316, #ea580c); border-radius: 1.5rem; padding: 2rem; color: #fff; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; box-shadow: 0 10px 25px rgba(249, 115, 22, 0.2); }
    .welcome-title { font-size: 1.5rem; font-weight: 800; margin: 0 0 .5rem; }
    .welcome-text { font-size: .95rem; opacity: .9; margin: 0; }
    .btn-welcome { background: #fff; color: #f97316; padding: .75rem 1.5rem; border-radius: .875rem; font-size: .9rem; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: .6rem; transition: all .2s; }
    .btn-welcome:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

    /* ── Stats ── */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .stat-card { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; padding: 1.25rem; display: flex; align-items: center; gap: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.02); transition: all .3s; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }
    .stat-icon { width: 56px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .icon-blue { background: #eff6ff; color: #3b82f6; }
    .icon-green { background: #f0fdf4; color: #22c55e; }
    .icon-orange { background: #fff7ed; color: #f97316; }
    .icon-purple { background: #f5f3ff; color: #8b5cf6; }
    .stat-info { display: flex; flex-direction: column; }
    .stat-label { font-size: .7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; }
    .stat-value { font-size: 1.35rem; font-weight: 800; color: #1e293b; line-height: 1.2; }
    .stat-value small { font-size: .85rem; color: #94a3b8; font-weight: 600; }

    /* ── Main Layout ── */
    .dashboard-main-grid { display: grid; grid-template-columns: 1fr 380px; gap: 1.5rem; }
    .dashboard-col { display: flex; flex-direction: column; gap: 1.5rem; }

    /* ── Card ── */
    .dashboard-card { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.02); overflow: hidden; }
    .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between; }
    .card-title { font-size: .95rem; font-weight: 800; color: #1e293b; margin: 0; display: flex; align-items: center; gap: .6rem; }
    .card-subtitle { font-size: .75rem; color: #94a3b8; font-weight: 600; }
    .card-body { padding: 1.5rem; }

    /* ── Table ── */
    .simple-table { width: 100%; border-collapse: collapse; }
    .simple-table th { background: #f8fafc; padding: .75rem 1.5rem; text-align: left; font-size: .65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; }
    .simple-table td { padding: 1rem 1.5rem; border-bottom: 1px solid #f8fafc; vertical-align: middle; }
    .td-product { display: flex; flex-direction: column; }
    .p-name { font-size: .85rem; font-weight: 700; color: #1e293b; }
    .p-cat { font-size: .7rem; color: #94a3b8; font-weight: 600; }
    .badge-qty { background: #f1f5f9; color: #475569; padding: .25rem .6rem; border-radius: .5rem; font-size: .75rem; font-weight: 800; }

    /* ── Alerts ── */
    .badge-count { padding: .2rem .5rem; border-radius: .5rem; font-size: .7rem; font-weight: 800; color: #fff; }
    .bg-red { background: #ef4444; }
    .bg-green { background: #22c55e; }
    .alert-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.5rem; border-bottom: 1px solid #f8fafc; transition: background .2s; }
    .alert-item:hover { background: #fcfcfc; }
    .alert-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
    .item-red .alert-icon { background: #fef2f2; color: #ef4444; }
    .item-amber .alert-icon { background: #fff7ed; color: #f59e0b; }
    .alert-info { flex: 1; min-width: 0; }
    .alert-name { font-size: .85rem; font-weight: 700; color: #1e293b; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .alert-status { font-size: .75rem; color: #64748b; margin: 2px 0 0; }
    .btn-refill { background: #f97316; color: #fff; padding: .3rem .75rem; border-radius: .5rem; font-size: .7rem; font-weight: 700; text-decoration: none; }
    .empty-alert { padding: 3rem 1.5rem; text-align: center; color: #cbd5e1; }
    .empty-alert i { font-size: 2.5rem; margin-bottom: .75rem; display: block; }
    .empty-alert p { font-size: .85rem; font-weight: 600; }

    /* ── Charts ── */
    .chart-container { height: 280px; position: relative; }
    .chart-mini { height: 220px; position: relative; }

    /* ── Shortcuts ── */
    .shortcut-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
    .shortcut-item { background: #fff; border-radius: 1.25rem; padding: 1rem; border: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: center; gap: .5rem; text-decoration: none; transition: all .2s; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
    .shortcut-item:hover { background: #f8fafc; border-color: #f97316; transform: translateY(-2px); }
    .shortcut-item i { font-size: 1.1rem; color: #f97316; }
    .shortcut-item span { font-size: .75rem; font-weight: 700; color: #475569; }

    /* ── Utilities ── */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

    @media (max-width: 1024px) {
        .dashboard-main-grid { grid-template-columns: 1fr; }
        .welcome-banner { flex-direction: column; text-align: center; gap: 1.5rem; }
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Trend Sales Chart
    const monthlyCtx = document.getElementById('monthlySalesChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Penjualan',
                    data: @json($chartData ?? []),
                    backgroundColor: '#f97316',
                    borderRadius: 8,
                    barThickness: 25,
                    hoverBackgroundColor: '#ea580c',
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Penjualan: Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { borderDash: [5, 5], color: '#f1f5f9' }, 
                        ticks: { 
                            font: { size: 10 }, 
                            callback: v => 'Rp' + v.toLocaleString('id-ID') 
                        } 
                    },
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    }

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart');
    if (categoryCtx) {
        const labels = @json($categoryLabels ?? []);
        const colors = labels.map(label => {
            const l = label.toLowerCase();
            if (l.includes('frozen')) return '#ef4444'; // Red
            if (l.includes('bakery')) return '#f59e0b'; // Amber/Orange
            return '#f97316'; // Default Orange
        });

        new Chart(categoryCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: @json($categoryData ?? []),
                    backgroundColor: colors,
                    borderWidth: 4, borderColor: '#fff'
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { 
                    legend: { position: 'bottom', labels: { boxWidth: 10, padding: 15, font: { size: 10, weight: 'bold' } } },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }
});
</script>
@endpush

@endsection
