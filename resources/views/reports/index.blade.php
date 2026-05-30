@extends('layouts.app')

@section('title', 'Laporan Bisnis')
@section('subtitle', 'Ringkasan performa penjualan dan pergerakan stok')

@section('content')

{{-- ── SUMMARY STATS ── --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-green"><i class="fas fa-coins"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Pendapatan</span>
            <span class="stat-value">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-blue"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Item Terjual</span>
            <span class="stat-value">{{ number_format($totalItemsSold) }} <small>Unit</small></span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-orange"><i class="fas fa-boxes"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Stok Masuk</span>
            <span class="stat-value">{{ number_format($totalStockIn) }} <small>Unit</small></span>
        </div>
    </div>
</div>

<div class="reports-main-grid">
    
    {{-- ── TOP SELLING PRODUCTS ── --}}
    <div class="report-card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-crown text-amber-500"></i> Produk Terlaris</h3>
        </div>
        <div class="card-body">
            @forelse($topProducts as $product)
            <div class="top-item">
                <div class="item-rank">{{ $loop->iteration }}</div>
                <div class="item-details">
                    <p class="item-name">{{ $product->name }}</p>
                    <p class="item-sub">{{ number_format($product->total_sold) }} unit terjual</p>
                </div>
                <div class="item-bar-wrap">
                    <div class="item-bar" style="width: {{ ($product->total_sold / ($topProducts->first()->total_sold ?: 1)) * 100 }}%"></div>
                </div>
            </div>
            @empty
            <p class="empty-text">Belum ada data penjualan</p>
            @endforelse
        </div>
    </div>

    {{-- ── REVENUE BY CATEGORY ── --}}
    <div class="report-card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-chart-pie text-indigo-500"></i> Pendapatan Kategori</h3>
        </div>
        <div class="card-body">
            @forelse($categoryRevenue as $cat)
            <div class="cat-revenue-item">
                <div class="cat-info">
                    <span class="cat-name">{{ $cat->name }}</span>
                    <span class="cat-value">Rp {{ number_format($cat->revenue, 0, ',', '.') }}</span>
                </div>
                <div class="cat-progress">
                    <div class="cat-progress-bar" style="width: {{ ($cat->revenue / ($categoryRevenue->first()->revenue ?: 1)) * 100 }}%"></div>
                </div>
            </div>
            @empty
            <p class="empty-text">Belum ada data kategori</p>
            @endforelse
        </div>
    </div>

    {{-- ── STOCK ALERTS ── --}}
    <div class="report-card full-width">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-bell text-red-500"></i> Peringatan Inventaris</h3>
            <a href="{{ route('reports.stock') }}" class="header-link">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="card-body alert-grid">
            <div class="alert-tile tile-amber">
                <div class="tile-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="tile-content">
                    <p class="tile-num">{{ $lowStockCount }}</p>
                    <p class="tile-label">Produk Stok Menipis</p>
                </div>
            </div>
            <div class="alert-tile tile-red">
                <div class="tile-icon"><i class="fas fa-times-circle"></i></div>
                <div class="tile-content">
                    <p class="tile-num">{{ $outOfStockCount }}</p>
                    <p class="tile-label">Produk Stok Habis</p>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* ── Stats ── */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
    .stat-card { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(15,23,42,.05); padding: 1.25rem; display: flex; align-items: center; gap: 1rem; }
    .stat-icon { width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .icon-green { background: #f0fdf4; color: #22c55e; }
    .icon-blue { background: #eff6ff; color: #3b82f6; }
    .icon-orange { background: #fff7ed; color: #f97316; }
    .stat-info { display: flex; flex-direction: column; }
    .stat-label { font-size: .7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; }
    .stat-value { font-size: 1.25rem; font-weight: 800; color: #1e293b; line-height: 1.2; }
    .stat-value small { font-size: .8rem; color: #94a3b8; font-weight: 600; }

    /* ── Main Grid ── */
    .reports-main-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .full-width { grid-column: span 2; }

    /* ── Report Card ── */
    .report-card { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); overflow: hidden; }
    .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between; }
    .card-title { font-size: .95rem; font-weight: 800; color: #1e293b; margin: 0; display: flex; align-items: center; gap: .6rem; }
    .card-body { padding: 1.5rem; }
    .header-link { font-size: .75rem; font-weight: 700; color: #6366f1; text-decoration: none; display: flex; align-items: center; gap: .4rem; }
    .header-link:hover { color: #4f46e5; }

    /* ── Top Items ── */
    .top-item { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem; }
    .item-rank { width: 24px; height: 24px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .7rem; font-weight: 800; color: #64748b; flex-shrink: 0; }
    .item-details { flex: 1; min-width: 0; }
    .item-name { font-size: .85rem; font-weight: 700; color: #334155; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .item-sub { font-size: .7rem; color: #94a3b8; margin: 0; }
    .item-bar-wrap { width: 80px; height: 6px; background: #f1f5f9; border-radius: 99px; overflow: hidden; }
    .item-bar { height: 100%; background: #6366f1; border-radius: 99px; }

    /* ── Category Revenue ── */
    .cat-revenue-item { margin-bottom: 1.25rem; }
    .cat-info { display: flex; justify-content: space-between; margin-bottom: .5rem; }
    .cat-name { font-size: .85rem; font-weight: 700; color: #334155; }
    .cat-value { font-size: .85rem; font-weight: 800; color: #1e293b; }
    .cat-progress { height: 8px; background: #f1f5f9; border-radius: 99px; overflow: hidden; }
    .cat-progress-bar { height: 100%; background: linear-gradient(90deg, #6366f1, #a855f7); border-radius: 99px; }

    /* ── Alert Tiles ── */
    .alert-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .alert-tile { padding: 1.25rem; border-radius: 1.25rem; display: flex; align-items: center; gap: 1.25rem; }
    .tile-amber { background: #fffbeb; border: 1px solid #fef3c7; }
    .tile-red { background: #fef2f2; border: 1px solid #fee2e2; }
    .tile-icon { width: 48px; height: 48px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; background: #fff; }
    .tile-amber .tile-icon { color: #d97706; }
    .tile-red .tile-icon { color: #dc2626; }
    .tile-num { font-size: 1.75rem; font-weight: 900; color: #1e293b; margin: 0; line-height: 1; }
    .tile-label { font-size: .75rem; font-weight: 700; color: #64748b; margin: 2px 0 0; }

    .empty-text { text-align: center; color: #cbd5e1; font-size: .8rem; font-weight: 600; padding: 2rem 0; }

    @media (max-width: 768px) {
        .reports-main-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
        .alert-grid { grid-template-columns: 1fr; }
    }
</style>

@endsection
