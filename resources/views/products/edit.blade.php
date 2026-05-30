@extends('layouts.app')

@section('title', 'Edit Produk')
@section('subtitle', 'Perbarui data produk di inventori')

@section('content')

{{-- ── ALERT ERROR ── --}}
@if(isset($errors) && $errors->any())
<div class="alert-banner alert-danger">
    <div class="alert-inner">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="margin:0;padding-left:1rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button onclick="this.closest('.alert-banner').remove()">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<div class="form-card">

    {{-- Card Header --}}
    <div class="form-card-header">
        <div class="form-card-title">
            <i class="fas fa-pencil-alt"></i>
            <div>
                <h2>Edit Produk</h2>
                <p>Perbarui informasi produk <strong>{{ $product->name }}</strong></p>
            </div>
        </div>
        <a href="{{ route('products.show', $product->id) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Form Body --}}
    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="form-body">
        @csrf
        @method('PUT')

        {{-- Upload Gambar --}}
        <div class="form-section">
            <div class="form-section-label">
                <i class="fas fa-image"></i> Gambar Produk
            </div>
            <div class="upload-area">
                <div style="position:relative;flex-shrink:0;">
                    <img id="preview"
                         src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/120x120?text=No+Image' }}"
                         id="current-image"
                         style="width:90px;height:90px;object-fit:cover;border-radius:10px;border:2px solid #e2e8f0;background:#fff;display:block;transition:opacity .2s;">
                </div>
                <div style="flex:1;">
                    <input type="file" name="image" id="image-upload" accept="image/*"
                           onchange="previewImage(this)" class="form-input" style="padding:.4rem;">
                    <p class="upload-hint">Format: JPG, JPEG, PNG · Maks. 2MB</p>
                    @if($product->image)
                    <label class="remove-img-label">
                        <input type="checkbox" name="remove_image" value="1" id="remove-image-checkbox"
                               onchange="toggleRemove(this)">
                        <i class="fas fa-trash-alt"></i> Hapus gambar saat ini
                    </label>
                    @endif
                </div>
            </div>
            @error('image')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        {{-- Nama Produk --}}
        <div class="form-section">
            <label class="form-section-label" for="name">
                <i class="fas fa-tag"></i> Nama Produk <span class="required">*</span>
            </label>
            <input type="text" name="name" id="name" required
                   value="{{ old('name', $product->name) }}"
                   placeholder="Masukkan nama produk..."
                   class="form-input @error('name') input-error @enderror">
            @error('name')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        {{-- Deskripsi --}}
        <div class="form-section">
            <label class="form-section-label" for="description">
                <i class="fas fa-align-left"></i> Deskripsi Produk
            </label>
            <textarea name="description" id="description" rows="3"
                      placeholder="Masukkan deskripsi produk..."
                      class="form-input @error('description') input-error @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')<p class="field-error">{{ $message }}</p>@enderror
        </div>

        {{-- Grid: Kategori & Harga --}}
        <div class="form-grid">
            <div class="form-section">
                <label class="form-section-label" for="category_id">
                    <i class="fas fa-layer-group"></i> Kategori <span class="required">*</span>
                </label>
                <select name="category_id" id="category_id" required
                        class="form-input @error('category_id') input-error @enderror">
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-section">
                <label class="form-section-label" for="price">
                    <i class="fas fa-money-bill-wave"></i> Harga <span class="required">*</span>
                </label>
                <div class="input-prefix-wrap">
                    <span class="input-prefix">Rp</span>
                    <input type="number" name="price" id="price" required min="0" step="100"
                           value="{{ old('price', $product->price) }}"
                           placeholder="0"
                           class="form-input with-prefix @error('price') input-error @enderror">
                </div>
                @error('price')<p class="field-error">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Grid: SKU & Satuan --}}
        <div class="form-grid">
            <div class="form-section">
                <label class="form-section-label" for="sku">
                    <i class="fas fa-barcode"></i> SKU (Kode Produk)
                </label>
                <input type="text" name="sku" id="sku"
                       value="{{ old('sku', $product->sku) }}"
                       placeholder="Contoh: SKU-001"
                       class="form-input @error('sku') input-error @enderror">
                @error('sku')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-section">
                <label class="form-section-label" for="unit">
                    <i class="fas fa-cube"></i> Satuan <span class="required">*</span>
                </label>
                <input type="text" name="unit" id="unit" required
                       value="{{ old('unit', $product->unit) }}"
                       placeholder="Contoh: pcs, box, kg"
                       class="form-input @error('unit') input-error @enderror">
                @error('unit')<p class="field-error">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Footer Buttons --}}
        <div class="form-footer">
            <a href="{{ route('products.show', $product->id) }}" class="btn-cancel">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn-submit update-mode">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<style>
    .alert-banner { display:flex;align-items:flex-start;justify-content:space-between;gap:.75rem;padding:.875rem 1.125rem;border-radius:.625rem;margin-bottom:1.25rem;font-size:.85rem;font-weight:500;animation:slideDown .3s ease; }
    @keyframes slideDown { from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)} }
    .alert-danger { background:#fef2f2;border:1px solid #fecaca;color:#991b1b; }
    .alert-inner { display:flex;align-items:flex-start;gap:.5rem; }
    .alert-banner button { background:none;border:none;cursor:pointer;color:inherit;opacity:.6;padding:2px; }
    .alert-banner button:hover { opacity:1; }

    .form-card { background:#fff;border-radius:.875rem;border:1px solid #f1f5f9;box-shadow:0 1px 4px rgba(15,23,42,.06);overflow:hidden;max-width:720px;margin:0 auto; }
    .form-card-header { display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #f1f5f9;gap:1rem;flex-wrap:wrap; }
    .form-card-title { display:flex;align-items:center;gap:.75rem; }
    .form-card-title > i { font-size:1.25rem;color:#f97316; }
    .form-card-title h2 { font-size:.95rem;font-weight:700;color:#1e293b;margin:0; }
    .form-card-title p { font-size:.75rem;color:#94a3b8;margin:2px 0 0; }

    .btn-back { display:inline-flex;align-items:center;gap:.4rem;padding:.45rem 1rem;border:1.5px solid #e2e8f0;background:#fff;color:#64748b;border-radius:.5rem;font-size:.8rem;font-weight:600;text-decoration:none;transition:background .15s,border-color .15s; }
    .btn-back:hover { background:#f8fafc;border-color:#cbd5e1;color:#374151; }

    .form-body { padding:1.5rem;display:flex;flex-direction:column;gap:1.25rem; }
    .form-grid { display:grid;grid-template-columns:1fr 1fr;gap:1.25rem; }
    .form-section { display:flex;flex-direction:column;gap:.375rem; }
    .form-section-label { font-size:.8rem;font-weight:600;color:#374151;display:flex;align-items:center;gap:.375rem; }
    .form-section-label i { color:#f97316;font-size:.7rem; }
    .required { color:#ef4444; }

    .form-input { width:100%;border:1.5px solid #e2e8f0;border-radius:.5rem;padding:.625rem .875rem;font-size:.825rem;color:#1e293b;background:#fafafa;outline:none;transition:border-color .18s,box-shadow .18s,background .18s;font-family:inherit;box-sizing:border-box; }
    .form-input:focus { border-color:#f97316;box-shadow:0 0 0 3px rgba(249,115,22,.12);background:#fff; }
    .input-error { border-color:#fca5a5 !important; }
    .field-error { font-size:.75rem;color:#ef4444;margin:2px 0 0; }

    .upload-area { display:flex;align-items:center;gap:1.5rem;background:#fafafa;padding:1rem;border-radius:.5rem;border:1px dashed #cbd5e1; }
    .upload-hint { font-size:.7rem;color:#94a3b8;margin:4px 0 0 2px; }
    .remove-img-label { display:inline-flex;align-items:center;gap:.35rem;font-size:.72rem;font-weight:600;color:#ef4444;cursor:pointer;margin-top:.5rem; }
    .remove-img-label input { accent-color:#ef4444; }

    .input-prefix-wrap { position:relative;display:flex;align-items:center; }
    .input-prefix { position:absolute;left:.75rem;font-size:.8rem;color:#64748b;font-weight:600;pointer-events:none; }
    .form-input.with-prefix { padding-left:2.5rem; }

    .form-footer { display:flex;justify-content:flex-end;gap:.625rem;padding-top:1.25rem;border-top:1px solid #f1f5f9;margin-top:.25rem; }
    .btn-cancel { display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1.125rem;border:1.5px solid #e2e8f0;background:#fff;color:#64748b;border-radius:.5rem;font-size:.825rem;font-weight:600;cursor:pointer;text-decoration:none;transition:background .15s,border-color .15s; }
    .btn-cancel:hover { background:#f8fafc;border-color:#cbd5e1;color:#374151; }
    .btn-submit { display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1.375rem;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;border-radius:.5rem;font-size:.825rem;font-weight:600;cursor:pointer;box-shadow:0 3px 10px rgba(249,115,22,.35);transition:box-shadow .2s,transform .15s; }
    .btn-submit:hover { box-shadow:0 5px 16px rgba(249,115,22,.45);transform:translateY(-1px); }
    .btn-submit.update-mode { background:linear-gradient(135deg,#22c55e,#16a34a);box-shadow:0 3px 10px rgba(34,197,94,.35); }
    .btn-submit.update-mode:hover { box-shadow:0 5px 16px rgba(34,197,94,.45); }

    @media(max-width:640px) {
        .form-grid { grid-template-columns:1fr; }
        .form-card-header { flex-direction:column;align-items:flex-start; }
    }
</style>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.opacity = '1';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function toggleRemove(checkbox) {
        const preview = document.getElementById('preview');
        if (preview) preview.style.opacity = checkbox.checked ? '0.35' : '1';
    }
</script>
@endpush
@endsection