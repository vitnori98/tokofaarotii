@extends('layouts.app')

@section('title', 'Edit Riwayat Stok')
@section('subtitle', 'Perbarui data transaksi stok')

@section('content')

{{-- ── BREADCRUMB ── --}}
<div class="breadcrumb-wrap">
    <a href="{{ route('stock-entries.index') }}" class="bc-link">
        <i class="fas fa-history"></i> Riwayat Stok
    </a>
    <i class="fas fa-chevron-right bc-sep"></i>
    <span class="bc-current">Edit Transaksi #{{ $stockEntry->id }}</span>
</div>

{{-- ── FORM CONTAINER ── --}}
<div class="form-container">
    <div class="form-card">
        <div class="card-header">
            <div class="header-icon-wrap">
                <i class="fas fa-pencil-alt"></i>
            </div>
            <div>
                <h2 class="internal-title">Edit Detail Transaksi</h2>
                <p class="internal-desc">Sesuaikan data jumlah atau tipe log transaksi stok</p>
            </div>
        </div>

        <form action="{{ route('stock-entries.update', $stockEntry) }}" method="POST" class="main-form">
            @csrf
            @method('PUT')

            {{-- Pilihan Produk --}}
            <div class="form-group">
                <label class="input-label">Produk</label>
                <div class="select-wrapper">
                    <select name="product_id" class="form-input" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $stockEntry->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} {{ $product->sku ? '('.$product->sku.')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down select-caret"></i>
                </div>
            </div>

            {{-- Tipe Transaksi --}}
            <div class="form-group">
                <label class="input-label">Tipe Transaksi</label>
                <div class="radio-toggle-group">
                    <label class="radio-tile">
                        <input type="radio" name="type" value="in" {{ $stockEntry->type === 'in' ? 'checked' : '' }} required>
                        <div class="tile-content text-success">
                            <i class="fas fa-arrow-down"></i>
                            <span>Stok Masuk</span>
                        </div>
                    </label>
                    <label class="radio-tile">
                        <input type="radio" name="type" value="out" {{ $stockEntry->type === 'out' ? 'checked' : '' }} required>
                        <div class="tile-content text-danger">
                            <i class="fas fa-arrow-up"></i>
                            <span>Stok Keluar</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Jumlah / Quantity --}}
            <div class="form-group">
                <label class="input-label">Jumlah (Quantity)</label>
                <div class="input-with-icon">
                    <i class="fas fa-calculator input-icon-inner"></i>
                    <input type="number" name="quantity" class="form-input icon-padded" min="1" value="{{ old('quantity', $stockEntry->quantity) }}" required>
                </div>
            </div>

            {{-- Tanggal Transaksi --}}
            <div class="form-group">
                <label class="input-label">Tanggal Transaksi</label>
                <div class="input-with-icon">
                    <i class="far fa-calendar-alt input-icon-inner"></i>
                    <input type="date" name="entry_date" class="form-input icon-padded" value="{{ old('entry_date', \Carbon\Carbon::parse($stockEntry->entry_date)->format('Y-m-d')) }}" required>
                </div>
            </div>

            {{-- Catatan --}}
            <div class="form-group">
                <label class="input-label">Catatan / Keterangan (Opsional)</label>
                <textarea name="notes" class="form-textarea" rows="4" placeholder="Contoh: Restock bulanan, barang retur, dll.">{{ old('notes', $stockEntry->notes) }}</textarea>
            </div>

            {{-- Action Buttons --}}
            <div class="form-actions">
                <a href="{{ route('stock-entries.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ─ Breadcrumb ─ */
    .breadcrumb-wrap { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; font-size: 0.8rem; }
    .bc-link { color: #f97316; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 0.3rem; }
    .bc-link:hover { text-decoration: underline; }
    .bc-sep { font-size: 0.6rem; color: #cbd5e1; }
    .bc-current { color: #64748b; font-weight: 500; }

    /* ─ Card Layout ─ */
    .form-container { max-width: 650px; margin: 0 auto; padding-bottom: 2rem; }
    .form-card { background: #fff; border-radius: 0.875rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03); padding: 1.75rem; }
    
    .card-header { display: flex; align-items: center; gap: 0.875rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1.25rem; margin-bottom: 1.5rem; }
    .header-icon-wrap { width: 40px; height: 40px; background: #fff7ed; color: #f97316; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
    .internal-title { margin: 0; font-size: 1.15rem; font-weight: 700; color: #1e293b; }
    .internal-desc { margin: 3px 0 0; font-size: 0.775rem; color: #94a3b8; }

    /* ─ Form Inputs ─ */
    .form-group { margin-bottom: 1.25rem; }
    .input-label { display: block; font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    
    .form-input, .form-textarea { width: 100%; padding: 0.65rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.875rem; color: #334155; background: #fff; box-sizing: border-box; transition: border-color 0.15s, box-shadow 0.15s; }
    .form-input:focus, .form-textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); }
    .form-textarea { resize: vertical; }

    /* Input Icon */
    .input-with-icon { position: relative; }
    .input-icon-inner { position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.9rem; pointer-events: none; }
    .icon-padded { padding-left: 2.5rem; }

    /* Select Caret */
    .select-wrapper { position: relative; }
    .select-wrapper select { appearance: none; -webkit-appearance: none; padding-right: 2.5rem; }
    .select-caret { position: absolute; right: 0.875rem; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.8rem; pointer-events: none; }

    /* ─ Radio Custom Tiles ─ */
    .radio-toggle-group { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.875rem; margin-top: 0.25rem; }
    .radio-tile { position: relative; display: block; cursor: pointer; }
    .radio-tile input { position: absolute; opacity: 0; width: 0; height: 0; }
    .tile-content { display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.75rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600; transition: all 0.15s; }
    
    /* Checked Style Logik */
    .radio-tile input:checked + .tile-content.text-success { background: #ecfdf5; border-color: #10b981; color: #059669; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.06); }
    .radio-tile input:checked + .tile-content.text-danger { background: #fef2f2; border-color: #ef4444; color: #dc2626; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.06); }
    .radio-tile:hover .tile-content { background: #f1f5f9; }

    /* ─ Actions Footer ─ */
    .form-actions { display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.75rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9; }
    .btn-cancel { display: inline-flex; align-items: center; justify-content: center; background: #f1f5f9; color: #475569; padding: 0.65rem 1.25rem; border-radius: 0.5rem; text-decoration: none; font-size: 0.85rem; font-weight: 600; transition: background 0.15s; }
    .btn-cancel:hover { background: #e2e8f0; }
    .btn-save { background: #6366f1; color: #fff; border: none; padding: 0.65rem 1.5rem; border-radius: 0.5rem; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: background 0.15s; }
    .btn-save:hover { background: #4f46e5; }
</style>

@endsection
