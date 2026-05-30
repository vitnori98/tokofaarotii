@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('subtitle', 'Kelola data produk inventori')

@section('content')

{{-- ── ALERT ── --}}
@if(session('success'))
<div class="alert-banner alert-success" id="alertBanner">
    <div class="alert-inner">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    <button onclick="this.closest('.alert-banner').remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

{{-- ── PAGE CARD ── --}}
<div class="prod-card">

    {{-- Card Header --}}
    <div class="prod-card-header">
        <div class="prod-card-title">
            <i class="fas fa-box"></i>
            <div>
                <h2>Daftar Produk</h2>
                <p>Kelola data produk dan stok inventori toko</p>
            </div>
        </div>
        <a href="{{ route('products.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Produk
        </a>
    </div>

    {{-- Toolbar: Filter & Search --}}
    <div class="prod-toolbar">
        <form action="{{ route('products.index') }}" method="GET" class="toolbar-left">
            <select name="category_id" onchange="this.form.submit()" class="filter-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="toolbar-right">
            <label class="search-label">Cari:</label>
            <form action="{{ route('products.index') }}" method="GET" class="search-wrap">
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                <i class="fas fa-search search-icon"></i>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari produk atau SKU..."
                       class="search-input">
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-wrap">
        <table class="prod-table">
            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th style="width:80px; text-align:center;">GAMBAR</th>
                    <th>NAMA PRODUK</th>
                    <th style="width:130px;">KATEGORI</th>
                    <th style="width:140px;">HARGA</th>
                    <th style="width:120px;">STOK</th>
                    <th class="col-action">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                @php
                    $totalStock  = $product->stockEntries->sum('quantity');
                    $totalSold   = $product->sales->sum('quantity_sold');
                    $currentStock = $totalStock - $totalSold;
                @endphp
                <tr class="prod-row">
                    {{-- NO --}}
                    <td class="col-no">
                        <span class="row-num">{{ $products->firstItem() + $index }}</span>
                    </td>

                    {{-- GAMBAR --}}
                    <td style="text-align:center;">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 alt="{{ $product->name }}"
                                 style="width:56px;height:56px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                        @else
                            <div class="img-placeholder">
                                <i class="fas fa-box"></i>
                            </div>
                        @endif
                    </td>

                    {{-- NAMA PRODUK --}}
                    <td>
                        <div class="prod-name">{{ $product->name }}</div>
                        @if($product->description)
                            <div class="prod-desc">{{ Str::limit($product->description, 55) }}</div>
                        @endif
                        @if($product->sku)
                            <div class="prod-sku">SKU: {{ $product->sku }}</div>
                        @endif
                    </td>

                    {{-- KATEGORI --}}
                    <td>
                        @if($product->category)
                            <span class="badge badge-blue">{{ $product->category->name }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    {{-- HARGA --}}
                    <td>
                        <div class="prod-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </td>

                    {{-- STOK --}}
                    <td>
                        <div class="stock-wrap">
                            <span class="stock-num">{{ $currentStock }}</span>
                            @if($currentStock <= 0)
                                <span class="badge badge-red">Habis</span>
                            @elseif($currentStock < 10)
                                <span class="badge badge-yellow">Rendah</span>
                            @else
                                <span class="badge badge-green">Aman</span>
                            @endif
                        </div>
                    </td>

                    {{-- AKSI --}}
                    <td class="col-action">
                        <div class="action-btns">
                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn-action btn-detail" title="Lihat Detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="btn-action btn-edit" title="Edit">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <p>Belum ada produk</p>
                        <a href="{{ route('products.create') }}" class="btn-primary" style="margin-top:.75rem;">
                            <i class="fas fa-plus"></i> Tambah Produk Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
    <div class="prod-pagination">
        <div class="pagination-info">
            Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
        </div>
        <div>{{ $products->links() }}</div>
    </div>
    @endif

</div>

{{-- ── QUICK STATS ── --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <p class="stat-label">Total Produk</p>
            <p class="stat-value">{{ $products->total() }}</p>
        </div>
        <div class="stat-icon" style="background:#eff6ff;">
            <i class="fas fa-box" style="color:#3b82f6;"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p class="stat-label">Kategori</p>
            <p class="stat-value">{{ \App\Models\Category::count() }}</p>
        </div>
        <div class="stat-icon" style="background:#f0fdf4;">
            <i class="fas fa-tags" style="color:#22c55e;"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p class="stat-label">Stok Rendah</p>
            @php
                $lowStockCount = 0;
                foreach($products as $product) {
                    $ts = $product->stockEntries->sum('quantity');
                    $so = $product->sales->sum('quantity_sold');
                    $cs = $ts - $so;
                    if($cs < 10 && $cs > 0) $lowStockCount++;
                }
            @endphp
            <p class="stat-value">{{ $lowStockCount }}</p>
        </div>
        <div class="stat-icon" style="background:#fffbeb;">
            <i class="fas fa-exclamation-triangle" style="color:#f59e0b;"></i>
        </div>
    </div>
</div>

{{-- ── STYLES ── --}}
<style>
    /* ─ Alert ─ */
    .alert-banner {
        display: flex; align-items: flex-start; justify-content: space-between; gap: .75rem;
        padding: .875rem 1.125rem; border-radius: .625rem; margin-bottom: 1.25rem;
        font-size: .85rem; font-weight: 500; animation: slideDown .3s ease;
    }
    @keyframes slideDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
    .alert-success { background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; }
    .alert-inner   { display:flex; align-items:flex-start; gap:.5rem; }
    .alert-banner button { background:none; border:none; cursor:pointer; color:inherit; opacity:.6; padding:2px; }
    .alert-banner button:hover { opacity:1; }

    /* ─ Card ─ */
    .prod-card { background:#fff; border-radius:.875rem; border:1px solid #f1f5f9; box-shadow:0 1px 4px rgba(15,23,42,.06); overflow:hidden; }

    /* ─ Card Header ─ */
    .prod-card-header { display:flex; align-items:center; justify-content:space-between; padding:1.25rem 1.5rem; border-bottom:1px solid #f1f5f9; gap:1rem; flex-wrap:wrap; }
    .prod-card-title  { display:flex; align-items:center; gap:.75rem; }
    .prod-card-title > i { font-size:1.25rem; color:#f97316; }
    .prod-card-title h2 { font-size:.95rem; font-weight:700; color:#1e293b; margin:0; }
    .prod-card-title p  { font-size:.75rem; color:#94a3b8; margin:2px 0 0; }

    /* ─ Primary Button ─ */
    .btn-primary {
        display:inline-flex; align-items:center; gap:.4rem; padding:.5rem 1rem;
        background:linear-gradient(135deg,#f97316,#ea580c); color:#fff; border:none; border-radius:.5rem;
        font-size:.825rem; font-weight:600; cursor:pointer; text-decoration:none;
        box-shadow:0 3px 10px rgba(249,115,22,.35); transition:box-shadow .2s,transform .15s; white-space:nowrap;
    }
    .btn-primary:hover { box-shadow:0 5px 16px rgba(249,115,22,.45); transform:translateY(-1px); color:#fff; }

    /* ─ Toolbar ─ */
    .prod-toolbar { display:flex; align-items:center; justify-content:space-between; padding:.875rem 1.5rem; border-bottom:1px solid #f8fafc; gap:1rem; flex-wrap:wrap; background:#fafafa; }
    .toolbar-left  { display:flex; align-items:center; gap:.5rem; }
    .toolbar-right { display:flex; align-items:center; gap:.5rem; }

    .filter-select {
        border:1px solid #e2e8f0; border-radius:.4rem; padding:.4rem .75rem;
        font-size:.8rem; color:#374151; background:#fff; outline:none; cursor:pointer;
        transition:border-color .18s, box-shadow .18s;
    }
    .filter-select:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.12); }

    .search-label { font-size:.8rem; color:#64748b; font-weight:500; }
    .search-wrap  { position:relative; display:flex; align-items:center; }
    .search-icon  { position:absolute; left:.625rem; font-size:.7rem; color:#94a3b8; }
    .search-input {
        padding:.4rem .75rem .4rem 1.875rem; border:1px solid #e2e8f0; border-radius:.4rem;
        font-size:.8rem; color:#1e293b; background:#fff; outline:none; width:220px;
        transition:border-color .18s, box-shadow .18s;
    }
    .search-input:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.12); }

    /* ─ Table ─ */
    .table-wrap  { overflow-x:auto; }
    .prod-table  { width:100%; border-collapse:collapse; font-size:.825rem; }
    .prod-table thead tr { background:#f8fafc; border-bottom:2px solid #f1f5f9; }
    .prod-table thead th {
        padding:.75rem 1rem; text-align:left; font-size:.7rem; font-weight:700;
        letter-spacing:.06em; text-transform:uppercase; color:#64748b; white-space:nowrap;
    }
    .col-no     { width:52px; }
    .col-action { width:115px; text-align:center !important; }
    .prod-row   { border-bottom:1px solid #f1f5f9; transition:background .15s; }
    .prod-row:hover { background:#fffbf7; }
    .prod-row td { padding:.875rem 1rem; vertical-align:middle; }

    /* ─ Row Elements ─ */
    .row-num { display:inline-flex;align-items:center;justify-content:center;width:26px;height:26px;border-radius:50%;background:#fff7ed;color:#f97316;font-size:.7rem;font-weight:700; }
    .img-placeholder { width:56px;height:56px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#cbd5e1;font-size:1.1rem;border:1px solid #e2e8f0; }
    .prod-name  { font-weight:600; color:#1e293b; line-height:1.4; }
    .prod-desc  { font-size:.75rem; color:#64748b; margin-top:2px; line-height:1.4; }
    .prod-sku   { font-size:.7rem; color:#94a3b8; margin-top:2px; }
    .prod-price { font-size:.85rem; font-weight:700; color:#1e293b; }
    .text-muted { color:#94a3b8; font-size:.8rem; }

    /* ─ Badges ─ */
    .badge { display:inline-block; padding:.2rem .55rem; border-radius:9999px; font-size:.7rem; font-weight:600; }
    .badge-blue   { background:#dbeafe; color:#1d4ed8; }
    .badge-green  { background:#dcfce7; color:#15803d; }
    .badge-yellow { background:#fef9c3; color:#a16207; }
    .badge-red    { background:#fee2e2; color:#b91c1c; }

    .stock-wrap { display:flex; align-items:center; gap:.5rem; }
    .stock-num  { font-size:.85rem; font-weight:600; color:#1e293b; }

    /* ─ Action Buttons (sama persis gaya berita) ─ */
    .action-btns { display:flex; flex-direction:column; gap:5px; align-items:center; }
    .btn-action {
        display:inline-flex; align-items:center; justify-content:center; gap:.3rem;
        padding:.3rem .75rem; border:none; border-radius:.35rem; font-size:.72rem; font-weight:600;
        cursor:pointer; transition:filter .15s,transform .1s; white-space:nowrap; width:85px;
        text-decoration:none;
    }
    .btn-action:hover { filter:brightness(1.1); transform:translateY(-1px); }
    .btn-detail { background:#2563eb; color:#fff; }
    .btn-edit   { background:#f59e0b; color:#fff; }
    .btn-delete { background:#ef4444; color:#fff; }

    /* ─ Empty State ─ */
    .empty-state { text-align:center; padding:3rem 1rem !important; color:#94a3b8; }
    .empty-state i { font-size:2.5rem; display:block; margin-bottom:.5rem; }
    .empty-state p { margin:.25rem 0 0; font-size:.9rem; }

    /* ─ Pagination ─ */
    .prod-pagination { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.5rem; border-top:1px solid #f1f5f9; background:#fafafa; flex-wrap:wrap; gap:.5rem; }
    .pagination-info { font-size:.8rem; color:#64748b; }

    /* ─ Stats ─ */
    .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.25rem; margin-top:1.5rem; }
    .stat-card  { background:#fff; border-radius:.875rem; border:1px solid #f1f5f9; box-shadow:0 1px 4px rgba(15,23,42,.06); padding:1.25rem 1.5rem; display:flex; align-items:center; justify-content:space-between; }
    .stat-info  { }
    .stat-label { font-size:.8rem; font-weight:500; color:#64748b; margin:0 0 4px; }
    .stat-value { font-size:1.6rem; font-weight:700; color:#1e293b; margin:0; line-height:1; }
    .stat-icon  { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }

    /* ─ Responsive ─ */
    @media (max-width:768px) {
        .stats-grid { grid-template-columns:1fr; }
        .prod-toolbar { flex-direction:column; align-items:flex-start; }
        .toolbar-right { width:100%; }
        .search-input  { width:100%; }
        .prod-card-header { flex-direction:column; align-items:flex-start; }
    }
</style>

{{-- Auto dismiss alert --}}
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert-banner').forEach(el => {
            el.style.transition = 'opacity .4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        });
    }, 4000);
</script>

@endsection