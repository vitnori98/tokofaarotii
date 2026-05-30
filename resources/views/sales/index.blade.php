@extends('layouts.app')

@section('title', 'Riwayat Penjualan')
@section('subtitle', 'Pantau semua transaksi masuk dari Frozen & Bakery')

@section('content')

{{-- ── ALERT ── --}}
@if(session('success'))
<div class="alert-banner alert-success">
    <div class="alert-inner"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>
    <button onclick="this.closest('.alert-banner').remove()"><i class="fas fa-times"></i></button>
</div>
@endif

@if(isset($errors) && $errors->any())
<div class="alert-banner alert-danger">
    <div class="alert-inner">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="margin:0;padding-left:1rem;">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    <button onclick="this.closest('.alert-banner').remove()"><i class="fas fa-times"></i></button>
</div>
@endif

{{-- ── SUMMARY STATS ── --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-blue"><i class="fas fa-wallet"></i></div>
        <div class="stat-info">
            <span class="stat-label">Total Pendapatan</span>
            <span class="stat-value">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-orange"><i class="fas fa-box-open"></i></div>
        <div class="stat-info">
            <span class="stat-label">Item Terjual</span>
            <span class="stat-value">{{ $totalItems }} <small>Unit</small></span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-green"><i class="fas fa-receipt"></i></div>
        <div class="stat-info">
            <span class="stat-label">Transaksi</span>
            <span class="stat-value">{{ $sales->total() }}</span>
        </div>
    </div>
</div>

{{-- ── TOOLBAR ── --}}
<div class="toolbar-wrap">
    <div class="toolbar-left">
        <h3 class="toolbar-title">Daftar Penjualan</h3>
    </div>
    <div class="toolbar-right">
        <a href="{{ route('sales.create') }}" class="btn-primary">
            <i class="fas fa-cart-plus"></i> Tambah Transaksi
        </a>
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="table-container">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>TANGGAL & PELANGGAN</th>
                    <th>PRODUK</th>
                    <th>SUMBER</th>
                    <th style="text-align:center;">QTY</th>
                    <th style="text-align:right;">TOTAL HARGA</th>
                    <th style="text-align:center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td>
                        <div class="td-flex">
                            <div class="td-date">{{ $sale->created_at->format('d M Y') }}</div>
                            <div class="td-sub-info text-indigo customer-name">{{ $sale->customer_name ?? 'Umum' }}</div>
                        </div>
                    </td>
                    <td>
                        <div class="td-product">
                            <div class="p-icon"><i class="fas fa-tag"></i></div>
                            <span class="p-name product-name">{{ $sale->product->name }}</span>
                        </div>
                    </td>
                    <td>
                        @if(($sale->source ?? 'offline') == 'online')
                            <span class="badge badge-online"><i class="fas fa-globe"></i> ONLINE</span>
                        @else
                            <span class="badge badge-offline"><i class="fas fa-store"></i> TOKO</span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        <span class="qty-badge sale-qty">{{ $sale->quantity_sold }}</span>
                    </td>
                    <td style="text-align:right;">
                        <span class="total-price sale-total">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</span>
                    </td>
                    <td>
                        <div class="action-group">
                            @if(($sale->status ?? 'completed') == 'pending')
                                <form action="{{ route('sales.confirm', $sale->id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit" class="btn-icon btn-amber" title="Konfirmasi">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @else
                                <div class="btn-icon btn-green-soft" title="Selesai">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            @endif

                            <button onclick="reprintStruk({{ $sale->id }})" class="btn-icon btn-blue" title="Cetak Struk">
                                <i class="fas fa-print"></i>
                            </button>

                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon btn-red" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <i class="fas fa-receipt"></i>
                        <p>Belum ada data penjualan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($sales->hasPages())
    <div class="pagination-wrap">
        {{ $sales->links() }}
    </div>
    @endif
</div>

<style>
    /* ── Stats ── */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
    .stat-card { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(15,23,42,.05); padding: 1.25rem; display: flex; align-items: center; gap: 1rem; }
    .stat-icon { width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .icon-blue { background: #eff6ff; color: #3b82f6; }
    .icon-orange { background: #fff7ed; color: #f97316; }
    .icon-green { background: #f0fdf4; color: #22c55e; }
    .stat-info { display: flex; flex-direction: column; }
    .stat-label { font-size: .7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; }
    .stat-value { font-size: 1.25rem; font-weight: 800; color: #1e293b; line-height: 1.2; }
    .stat-value small { font-size: .8rem; color: #94a3b8; font-weight: 600; }

    /* ── Toolbar ── */
    .toolbar-wrap { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .toolbar-title { font-size: 1.125rem; font-weight: 800; color: #1e293b; margin: 0; }
    .btn-primary { background: #6366f1; color: #fff; padding: .625rem 1.25rem; border-radius: .75rem; font-size: .85rem; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: .5rem; transition: all .2s; }
    .btn-primary:hover { background: #4f46e5; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(99, 102, 241, .2); }

    /* ── Table ── */
    .table-container { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(15,23,42,.05); overflow: hidden; }
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8fafc; padding: 1rem 1.25rem; text-align: left; font-size: .65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; }
    td { padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    
    .td-flex { display: flex; flex-direction: column; gap: 2px; }
    .td-date { font-size: .85rem; font-weight: 700; color: #1e293b; }
    .td-sub-info { font-size: .65rem; font-weight: 800; text-transform: uppercase; letter-spacing: .05em; }
    .text-indigo { color: #6366f1; }

    .td-product { display: flex; align-items: center; gap: .75rem; }
    .p-icon { width: 32px; height: 32px; background: #f8fafc; border-radius: .5rem; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: .75rem; }
    .p-name { font-size: .85rem; font-weight: 600; color: #475569; }

    .badge { display: inline-flex; align-items: center; gap: .3rem; padding: .25rem .625rem; border-radius: 9999px; font-size: .65rem; font-weight: 800; letter-spacing: .04em; }
    .badge-online { background: #eff6ff; color: #1e40af; }
    .badge-offline { background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; }

    .qty-badge { display: inline-block; padding: .2rem .6rem; background: #f1f5f9; border-radius: .5rem; font-size: .75rem; font-weight: 800; color: #475569; }
    .total-price { font-size: .9rem; font-weight: 800; color: #6366f1; }

    .action-group { display: flex; align-items: center; justify-content: center; gap: .5rem; }
    .btn-icon { width: 34px; height: 34px; border-radius: .625rem; display: flex; align-items: center; justify-content: center; font-size: .8rem; cursor: pointer; border: none; transition: all .2s; text-decoration: none; }
    .btn-amber { background: #fffbeb; color: #d97706; }
    .btn-amber:hover { background: #d97706; color: #fff; }
    .btn-green-soft { background: #f0fdf4; color: #22c55e; cursor: default; }
    .btn-blue { background: #eff6ff; color: #3b82f6; border: 1px solid #dbeafe; }
    .btn-blue:hover { background: #3b82f6; color: #fff; }
    .btn-red { background: #fef2f2; color: #ef4444; border: 1px solid #fee2e2; }
    .btn-red:hover { background: #ef4444; color: #fff; }

    .empty-state { text-align: center; padding: 4rem 1rem !important; color: #cbd5e1; }
    .empty-state i { font-size: 2.5rem; margin-bottom: 1rem; display: block; }
    .empty-state p { font-size: .85rem; font-weight: 600; color: #94a3b8; }

    .pagination-wrap { padding: 1.25rem; background: #f8fafc; border-top: 1px solid #f1f5f9; }

    /* ── Alert ── */
    .alert-banner { display:flex;align-items:flex-start;justify-content:space-between;gap:.75rem;padding:.875rem 1.125rem;border-radius:.75rem;margin-bottom:1.5rem;font-size:.85rem;font-weight:600; }
    .alert-success { background:#f0fdf4;border:1px solid #bbf7d0;color:#166534; }
    .alert-danger { background:#fef2f2;border:1px solid #fee2e2;color:#991b1b; }
    .alert-inner { display:flex;align-items:flex-start;gap:.5rem; }
    .alert-banner button { background:none;border:none;cursor:pointer;color:inherit;opacity:.6; }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
        .toolbar-wrap { flex-direction: column; align-items: stretch; gap: 1rem; }
        .btn-primary { justify-content: center; }
    }
</style>

<script>
function reprintStruk(id) {
    const btn = event.currentTarget;
    const row = btn.closest('tr');
    const tanggal = row.querySelector('.td-date').innerText;
    const pelanggan = row.querySelector('.customer-name').innerText;
    const produk = row.querySelector('.product-name').innerText;
    const qty = row.querySelector('.sale-qty').innerText;
    const total = row.querySelector('.sale-total').innerText;

    let strukWindow = window.open('', '', 'width=400,height=600');
    
    strukWindow.document.write(`
        <html>
        <body style="font-family: 'Courier New', Courier, monospace; width: 300px; padding: 10px;">
            <div style="text-align: center; border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px;">
                <h2 style="margin: 0; font-size: 18px;">TOKO FAA</h2>
                <p style="margin: 0; font-size: 10px;">Frozen Food & Bakery</p>
                <p style="margin: 0; font-size: 10px;">(COPY STRUK)</p>
            </div>
            <div style="font-size: 11px; margin-bottom: 10px;">
                <div>Tgl: ${tanggal}</div>
                <div>Pelanggan: ${pelanggan}</div>
            </div>
            <div style="border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px;">
                <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 5px;">
                    <span>${qty}x ${produk}</span>
                    <span>${total}</span>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 14px; margin-bottom: 10px;">
                <span>TOTAL</span>
                <span>${total}</span>
            </div>
            <div style="text-align: center; font-size: 10px; margin-top: 20px;">
                *** Terima Kasih ***<br>Cetakan Ulang
            </div>
        </body>
        </html>
    `);

    strukWindow.document.close();
    setTimeout(() => {
        strukWindow.print();
        strukWindow.close();
    }, 500);
}

// Auto-dismiss alerts
setTimeout(() => {
    document.querySelectorAll('.alert-banner').forEach(el => {
        el.style.transition = 'opacity .4s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 400);
    });
}, 4000);
</script>

@endsection
