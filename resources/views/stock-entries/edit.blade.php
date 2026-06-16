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
    <span class="bc-current">Edit Transaksi</span>
</div>

<div class="form-container">
    <div class="form-card">
        <div class="card-header">
            <i class="fas fa-pencil-alt header-icon"></i>
            <div>
                <h2 class="card-title">Edit Riwayat Stok</h2>
                <p class="card-desc">ID Transaksi: #{{ $stockEntry->id }}</p>
            </div>
        </div>

        <form action="{{ route('stock-entries.update', $stockEntry) }}" method="POST" class="main-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="input-label">Produk</label>
                <div class="select-wrapper">
                    <select name="product_id" class="form-input" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ (old('product_id', $stockEntry->product_id) == $product->id) ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->sku ?? 'No SKU' }})
                            </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down select-arrow"></i>
                </div>
                @error('product_id') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <input type="hidden" name="type" value="in">

            <div class="form-row">
                <div class="form-group">
                    <label class="input-label">Jumlah (Qty)</label>
                    <input type="number" name="quantity" min="1" step="1" 
                           value="{{ old('quantity', $stockEntry->quantity) }}" 
                           class="form-input" placeholder="0" required>
                    @error('quantity') <p class="error-text">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="input-label">Tanggal Transaksi</label>
                    <div class="input-with-icon">
                        <i class="far fa-calendar-alt input-icon-inner"></i>
                        <input type="date" name="entry_date" 
                               value="{{ old('entry_date', \Carbon\Carbon::parse($stockEntry->entry_date)->format('Y-m-d')) }}" 
                               class="form-input icon-padded" required>
                    </div>
                    @error('entry_date') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="input-label">Catatan (Opsional)</label>
                <textarea name="notes" rows="3" class="form-input" 
                          placeholder="Contoh: Barang rusak, retur supplier, dll...">{{ old('notes', $stockEntry->notes) }}</textarea>
                @error('notes') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('stock-entries.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .breadcrumb-wrap { display:flex;align-items:center;gap:.5rem;margin-bottom:1.5rem;font-size:.85rem; }
    .bc-link { color:#6366f1;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:.3rem; }
    .bc-sep { color:#94a3b8;font-size:.7rem; }
    .bc-current { color:#475569;font-weight:500; }

    .form-container { max-width: 650px; margin: 0 auto; }
    .form-card { background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; }
    
    .card-header { padding: 1.5rem; background: #f8fafc; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem; }
    .header-icon { width: 45px; height: 45px; background: #fef3c7; color: #d97706; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .card-title { font-size: 1.15rem; font-weight: 800; color: #1e293b; margin: 0; }
    .card-desc { font-size: 0.8rem; color: #64748b; font-weight: 500; margin: 0; }

    .main-form { padding: 1.5rem; }
    .form-group { margin-bottom: 1.25rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    
    .input-label { display: block; font-size: 0.8rem; font-weight: 700; color: #475569; margin-bottom: 0.5rem; }
    .form-input { width: 100%; padding: 0.7rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.9rem; color: #1e293b; transition: all 0.2s; box-sizing: border-box; }
    .form-input:focus { border-color: #6366f1; outline: none; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); }
    
    .select-wrapper { position: relative; }
    .select-arrow { position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.8rem; pointer-events: none; }
    
    .input-with-icon { position: relative; }
    .input-icon-inner { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.9rem; }
    .icon-padded { padding-left: 2.75rem; }

    .error-text { font-size: 0.75rem; color: #ef4444; font-weight: 600; margin-top: 0.4rem; }

    .form-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9; }
    .btn-cancel { padding: 0.7rem 1.5rem; background: #fff; border: 1.5px solid #e2e8f0; color: #64748b; font-size: 0.85rem; font-weight: 700; border-radius: 0.625rem; text-decoration: none; transition: all 0.2s; }
    .btn-cancel:hover { background: #f8fafc; border-color: #cbd5e1; color: #475569; }
    
    .btn-submit { padding: 0.7rem 1.5rem; background: #6366f1; border: none; color: #fff; font-size: 0.85rem; font-weight: 700; border-radius: 0.625rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
    .btn-submit:hover { background: #4f46e5; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2); }

    @media (max-width: 500px) {
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .form-actions { flex-direction: column-reverse; }
        .btn-cancel, .btn-submit { width: 100%; justify-content: center; }
    }
</style>

@endsection
