@extends('layouts.app')

@section('title', 'Detail Riwayat Stok')
@section('subtitle', 'Informasi lengkap transaksi stok')

@section('content')

{{-- ── BREADCRUMB ── --}}
<div class="breadcrumb-wrap">
    <a href="{{ route('stock-entries.index') }}" class="bc-link">
        <i class="fas fa-history"></i> Riwayat Stok
    </a>
    <i class="fas fa-chevron-right bc-sep"></i>
    <span class="bc-current">Detail Transaksi</span>
</div>

<div class="detail-container">
    <div class="detail-card main-card">
        <div class="card-header">
            <div class="header-left">
                <div class="type-badge badge-in">
                    <i class="fas fa-arrow-down"></i>
                    STOK MASUK
                </div>
                <h1 class="entry-title">{{ $stockEntry->product->name }}</h1>
            </div>
            <div class="header-right">
                <div class="date-tag">
                    <i class="far fa-calendar-alt"></i>
                    {{ \Carbon\Carbon::parse($stockEntry->entry_date)->translatedFormat('d M Y') }}
                </div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <label>Produk</label>
                <div class="value-wrap">
                    <div class="product-icon"><i class="fas fa-box"></i></div>
                    <div class="product-text">
                        <p class="p-name">{{ $stockEntry->product->name }}</p>
                        <p class="p-sku">SKU: {{ $stockEntry->product->sku ?? '-' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="info-item">
                <label>Jumlah (Quantity)</label>
                <div class="value-wrap">
                    <span class="qty-value text-green">
                        +{{ $stockEntry->quantity }}
                    </span>
                    <span class="unit-label">{{ $stockEntry->product->unit ?? 'pcs' }}</span>
                </div>
            </div>

            <div class="info-item full-width">
                <label>Catatan / Keterangan</label>
                <div class="notes-box">
                    {{ $stockEntry->notes ?: 'Tidak ada catatan tambahan.' }}
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="metadata">
                <span><i class="far fa-clock"></i> Dicatat pada {{ $stockEntry->created_at->translatedFormat('d/m/Y H:i') }}</span>
            </div>
            <div class="actions">
                <a href="{{ route('stock-entries.edit', $stockEntry) }}" class="btn-edit">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a>
                <form action="{{ route('stock-entries.destroy', $stockEntry) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .breadcrumb-wrap { display:flex;align-items:center;gap:.5rem;margin-bottom:1.5rem;font-size:.85rem; }
    .bc-link { color:#6366f1;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:.3rem; }
    .bc-sep { color:#94a3b8;font-size:.7rem; }
    .bc-current { color:#475569;font-weight:500; }

    .detail-container { max-width: 800px; margin: 0 auto; }
    .main-card { background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; }
    
    .card-header { padding: 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: flex-start; background: #f8fafc; }
    .type-badge { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 800; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .badge-in { background: #dcfce7; color: #166534; }
    .badge-out { background: #fee2e2; color: #991b1b; }
    .entry-title { font-size: 1.25rem; font-weight: 800; color: #1e293b; margin: 0; }
    .date-tag { display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; color: #64748b; font-weight: 500; background: #fff; padding: 0.4rem 0.8rem; border-radius: 0.5rem; border: 1px solid #e2e8f0; }

    .info-grid { padding: 1.5rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .info-item label { display: block; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .full-width { grid-column: span 2; }
    
    .value-wrap { display: flex; align-items: center; gap: 0.75rem; }
    .product-icon { width: 40px; height: 40px; background: #eff6ff; color: #3b82f6; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
    .p-name { font-size: 0.95rem; font-weight: 700; color: #1e293b; margin: 0; }
    .p-sku { font-size: 0.75rem; color: #64748b; margin: 0; }
    
    .qty-value { font-size: 1.5rem; font-weight: 800; }
    .text-green { color: #16a34a; }
    .text-red { color: #dc2626; }
    .unit-label { font-size: 0.85rem; font-weight: 600; color: #64748b; }

    .notes-box { padding: 1rem; background: #f8fafc; border-radius: 0.75rem; border: 1px solid #f1f5f9; font-size: 0.9rem; color: #475569; line-height: 1.5; min-height: 80px; }

    .card-footer { padding: 1.25rem 1.5rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .metadata { font-size: 0.75rem; color: #94a3b8; font-weight: 500; }
    .actions { display: flex; gap: 0.75rem; }
    
    .btn-edit { background: #f59e0b; color: #fff; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 0.4rem; transition: all 0.2s; }
    .btn-edit:hover { background: #d97706; transform: translateY(-1px); }
    
    .btn-delete { background: #ef4444; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 0.4rem; cursor: pointer; transition: all 0.2s; }
    .btn-delete:hover { background: #dc2626; transform: translateY(-1px); }

    @media (max-width: 600px) {
        .info-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
        .card-header { flex-direction: column; gap: 1rem; }
        .card-footer { flex-direction: column; gap: 1rem; align-items: flex-start; }
    }
</style>

@endsection
