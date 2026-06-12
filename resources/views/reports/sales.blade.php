@extends('layouts.app')

@section('title', 'Laporan Penjualan')
@section('subtitle', 'Data transaksi berdasarkan rentang waktu tertentu')

@section('content')

{{-- ── FILTER BOX ── --}}
<div class="filter-card">
    <form method="GET" action="{{ route('reports.sales') }}" class="filter-form">
        <div class="filter-group">
            <label>Mulai</label>
            <div class="input-with-icon">
                <i class="far fa-calendar-alt"></i>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}">
            </div>
        </div>
        <div class="filter-group">
            <label>Sampai</label>
            <div class="input-with-icon">
                <i class="far fa-calendar-alt"></i>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}">
            </div>
        </div>
        <div class="filter-group">
            <label>Kategori</label>
            <div class="input-with-icon">
                <i class="fas fa-tags"></i>
                <select name="category_id">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="filter-group">
            <label>Grup Data</label>
            <div class="input-with-icon">
                <i class="fas fa-layer-group"></i>
                <select name="group_by">
                    <option value="day" {{ $groupBy == 'day' ? 'selected' : '' }}>Harian</option>
                    <option value="week" {{ $groupBy == 'week' ? 'selected' : '' }}>Mingguan</option>
                    <option value="month" {{ $groupBy == 'month' ? 'selected' : '' }}>Bulanan</option>
                    <option value="year" {{ $groupBy == 'year' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn-filter">
            <i class="fas fa-filter"></i> Filter
        </button>
    </form>
</div>

{{-- ── SUMMARY ── --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-green"><i class="fas fa-money-bill-wave"></i></div>
        <div class="stat-info">
            <span class="stat-label">Pendapatan (Periode)</span>
            <span class="stat-value">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-blue"><i class="fas fa-shopping-basket"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Terjual</span>
            <span class="stat-value">{{ number_format($totalItems) }} <small>Unit</small></span>
        </div>
    </div>
</div>

{{-- ── CHART SECTION ── --}}
<div class="dashboard-card mb-6">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chart-bar text-indigo-500"></i> Grafik Tren Penjualan</h3>
        <span class="card-subtitle">Dikelompokkan per {{ ucfirst($groupBy) }}</span>
    </div>
    <div class="card-body">
        <div class="chart-container" style="height: 300px;">
            <canvas id="reportSalesChart"></canvas>
        </div>
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="table-container">
    <div class="table-header">
        <h3 class="table-title">Rincian Transaksi</h3>
        <button onclick="window.print()" class="btn-print-outline">
            <i class="fas fa-print"></i> Cetak Laporan
        </button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">NO</th>
                    <th>TANGGAL</th>
                    <th>PRODUK</th>
                    <th style="text-align:center;">QTY</th>
                    <th style="text-align:right;">TOTAL HARGA</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $index => $sale)
                <tr>
                    <td class="td-no">{{ $index + 1 }}</td>
                    <td class="td-date">{{ \Carbon\Carbon::parse($sale->created_at)->translatedFormat('d M Y') }}</td>
                    <td>
                        <span class="p-name">{{ $sale->product->name ?? '-' }}</span>
                    </td>
                    <td style="text-align:center;">
                        <span class="qty-badge">{{ $sale->quantity_sold }}</span>
                    </td>
                    <td style="text-align:right;">
                        <span class="total-price">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <p>Tidak ada data penjualan pada periode ini</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* ── Filter ── */
    .filter-card { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; padding: 1.25rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(15,23,42,.05); }
    .filter-form { display: flex; align-items: flex-end; gap: 1.25rem; flex-wrap: wrap; }
    .filter-group { flex: 1; min-width: 200px; }
    .filter-group label { display: block; font-size: .75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: .5rem; }
    .input-with-icon { position: relative; }
    .input-with-icon i { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: .85rem; }
    .input-with-icon input, .input-with-icon select { width: 100%; padding: .625rem 1rem .625rem 2.5rem; border: 1.5px solid #e2e8f0; border-radius: .75rem; font-size: .85rem; outline: none; transition: all .2s; box-sizing: border-box; background: #fff; appearance: none; }
    .input-with-icon select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C2.185 5.355 2.403 5 2.801 5h10.398c.398 0 .616.355.35.658l-4.796 5.482a.503.503 0 0 1-.754 0z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; }
    .input-with-icon input:focus, .input-with-icon select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, .1); }
    .btn-filter { background: #6366f1; color: #fff; border: none; padding: .625rem 1.5rem; border-radius: .75rem; font-size: .85rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: .5rem; transition: all .2s; }
    .btn-filter:hover { background: #4f46e5; transform: translateY(-1px); }

    /* ── Stats ── */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
    .stat-card { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(15,23,42,.05); padding: 1.25rem; display: flex; align-items: center; gap: 1rem; }
    .stat-icon { width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .icon-green { background: #f0fdf4; color: #22c55e; }
    .icon-blue { background: #eff6ff; color: #3b82f6; }
    .stat-info { display: flex; flex-direction: column; }
    .stat-label { font-size: .7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; }
    .stat-value { font-size: 1.25rem; font-weight: 800; color: #1e293b; line-height: 1.2; }
    .stat-value small { font-size: .8rem; color: #94a3b8; font-weight: 600; }

    /* ── Chart ── */
    .mb-6 { margin-bottom: 1.5rem; }
    .dashboard-card { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(15,23,42,.05); overflow: hidden; }
    .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between; }
    .card-title { font-size: .95rem; font-weight: 800; color: #1e293b; margin: 0; display: flex; align-items: center; gap: .6rem; }
    .card-subtitle { font-size: .75rem; color: #94a3b8; font-weight: 600; }
    .card-body { padding: 1.5rem; }
    .chart-container { position: relative; width: 100%; }

    /* ── Table ── */
    .table-container { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(15,23,42,.05); overflow: hidden; }
    .table-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between; }
    .table-title { font-size: .95rem; font-weight: 800; color: #1e293b; margin: 0; }
    .btn-print-outline { background: #fff; border: 1.5px solid #e2e8f0; color: #64748b; padding: .5rem 1rem; border-radius: .625rem; font-size: .75rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: .4rem; transition: all .2s; }
    .btn-print-outline:hover { background: #f8fafc; border-color: #cbd5e1; color: #475569; }

    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8fafc; padding: 1rem 1.5rem; text-align: left; font-size: .65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; }
    td { padding: 1rem 1.5rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    
    .td-no { font-size: .75rem; font-weight: 800; color: #cbd5e1; }
    .td-date { font-size: .85rem; font-weight: 700; color: #475569; }
    .p-name { font-size: .85rem; font-weight: 700; color: #1e293b; }
    .qty-badge { display: inline-block; padding: .2rem .6rem; background: #f1f5f9; border-radius: .5rem; font-size: .75rem; font-weight: 800; color: #475569; }
    .total-price { font-size: .9rem; font-weight: 800; color: #6366f1; }

    .empty-state { text-align: center; padding: 4rem 1rem !important; color: #cbd5e1; }
    .empty-state i { font-size: 2.5rem; margin-bottom: 1rem; display: block; }
    .empty-state p { font-size: .85rem; font-weight: 600; color: #94a3b8; }

    @media (max-width: 600px) {
        .filter-form { flex-direction: column; align-items: stretch; }
        .btn-filter { justify-content: center; }
        .stats-grid { grid-template-columns: 1fr; }
    }

    @media print {
        .filter-card, .btn-print-outline { display: none; }
        .table-container { border: none; box-shadow: none; }
        body { background: #fff; }
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('reportSalesChart');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($chartData['labels'] ?? []),
                datasets: [
                    {
                        label: 'Pendapatan (Rp)',
                        data: @json($chartData['revenue'] ?? []),
                        backgroundColor: '#6366f1',
                        borderRadius: 6,
                        yAxisID: 'y',
                    },
                    {
                        label: 'Qty Terjual',
                        data: @json($chartData['qty'] ?? []),
                        backgroundColor: '#10b981',
                        borderRadius: 6,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#f1f5f9' },
                        ticks: {
                            callback: v => 'Rp' + v.toLocaleString('id-ID')
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        beginAtZero: true,
                        grid: { drawOnChartArea: false },
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { boxWidth: 12, font: { weight: 'bold' } }
                    }
                }
            }
        });
    }
});
</script>
@endpush

@endsection
