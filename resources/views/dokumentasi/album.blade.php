@extends('layouts.app')

@section('title', 'Album Kegiatan')
@section('subtitle', 'Kumpulan dokumentasi foto kegiatan Toko Faa')

@section('content')

{{-- ── ALERT ── --}}
@if(session('success'))
<div class="alert-banner alert-success">
    <div class="alert-inner"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>
    <button onclick="this.closest('.alert-banner').remove()"><i class="fas fa-times"></i></button>
</div>
@endif

{{-- ── TOOLBAR ── --}}
<div class="toolbar-wrap">
    <div class="toolbar-left">
        <h3 class="toolbar-title">Galeri Album</h3>
    </div>
    <div class="toolbar-right">
        <button onclick="toggleModal('modal-tambah')" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Album
        </button>
    </div>
</div>

{{-- ── GRID ALBUM ── --}}
@if($albums->isEmpty())
    <div class="empty-state-card">
        <i class="fas fa-images"></i>
        <p>Belum ada album kegiatan</p>
    </div>
@else
    <div class="album-grid">
        @foreach($albums as $album)
        <div class="album-card">
            <div class="album-img-wrap">
                @if($album->gambar)
                    <img src="{{ asset('storage/' . $album->gambar) }}" alt="{{ $album->judul }}">
                @else
                    <div class="img-placeholder">
                        <i class="fas fa-image"></i>
                    </div>
                @endif
                <div class="album-date">
                    <i class="far fa-calendar-alt"></i> 
                    {{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') : 'N/A' }}
                </div>
            </div>
            <div class="album-content">
                <h4 class="album-title">{{ $album->judul }}</h4>
                <p class="album-desc">{{ Str::limit($album->deskripsi, 80) }}</p>
                <div class="album-actions-standard">
                    <button onclick="editAlbum({{ json_encode($album) }})" class="btn-action btn-edit" title="Edit">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form action="{{ route('dokumentasi.album.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Hapus album ini?')" style="margin:0;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($albums->hasPages())
    <div class="pagination-wrap" style="margin-top: 2rem; display: flex; justify-content: center;">
        {{ $albums->links() }}
    </div>
    @endif
@endif

{{-- ── MODAL TAMBAH ── --}}
<div id="modal-tambah" class="modal-overlay hidden">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Album Baru</h3>
            <button onclick="toggleModal('modal-tambah')" class="btn-close-modal"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('dokumentasi.album.store') }}" method="POST" enctype="multipart/form-data" class="modal-form">
            @csrf
            <div class="form-group">
                <label>Judul Kegiatan</label>
                <input type="text" name="judul" required placeholder="Contoh: Grand Opening Cabang Baru">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal">
                </div>
                <div class="form-group">
                    <label>Cover Album</label>
                    <input type="file" name="gambar" accept="image/*" required>
                </div>
            </div>
            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" placeholder="Ceritakan singkat tentang kegiatan ini..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="toggleModal('modal-tambah')" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-submit">Simpan Album</button>
            </div>
        </form>
    </div>
</div>

{{-- ── MODAL EDIT ── --}}
<div id="modal-edit" class="modal-overlay hidden">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Edit Album</h3>
            <button onclick="toggleModal('modal-edit')" class="btn-close-modal"><i class="fas fa-times"></i></button>
        </div>
        <form id="form-edit" method="POST" enctype="multipart/form-data" class="modal-form">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Judul Kegiatan</label>
                <input type="text" name="judul" id="edit-judul" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" id="edit-tanggal">
                </div>
                <div class="form-group">
                    <label>Ganti Cover (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" id="edit-deskripsi" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="toggleModal('modal-edit')" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-submit">Update Album</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ── Toolbar ── */
    .toolbar-wrap { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; }
    .toolbar-title { font-size: 1.25rem; font-weight: 800; color: #1e293b; margin: 0; }
    .btn-primary { background: #6366f1; color: #fff; border: none; padding: .625rem 1.25rem; border-radius: .75rem; font-size: .85rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: .5rem; transition: all .2s; }
    .btn-primary:hover { background: #4f46e5; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(99, 102, 241, .2); }

    /* ── Grid ── */
    .album-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
    .album-card { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 1px 3px rgba(15,23,42,.05); transition: all .3s; }
    .album-card:hover { transform: translateY(-5px); box-shadow: 0 12px 20px rgba(15,23,42,.08); }
    
    .album-img-wrap { position: relative; width: 100%; aspect-ratio: 16/9; background: #f8fafc; overflow: hidden; }
    .album-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .img-placeholder { height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 2rem; }
    
    .album-date { position: absolute; bottom: .75rem; left: .75rem; background: rgba(15,23,42,.7); color: #fff; padding: .25rem .6rem; border-radius: .5rem; font-size: .65rem; font-weight: 700; backdrop-filter: blur(4px); }

    .album-content { padding: 1.25rem; }
    .album-title { font-size: .95rem; font-weight: 800; color: #1e293b; margin: 0 0 .5rem; line-height: 1.4; }
    .album-desc { font-size: .8rem; color: #64748b; line-height: 1.5; margin-bottom: 1.25rem; }

    .album-actions-standard { display: flex; align-items: center; gap: .5rem; border-top: 1px solid #f8fafc; padding-top: 1rem; justify-content: center; }
    .btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 0.3rem; padding: 0.3rem 0.75rem; border: none; border-radius: 0.35rem; font-size: 0.72rem; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap; width: 80px; }
    .btn-action:hover { filter: brightness(1.1); transform: translateY(-1px); }
    .btn-edit { background: #f59e0b; color: #fff; }
    .btn-delete { background: #ef4444; color: #fff; }

    /* ── Modal ── */
    .modal-overlay { position: fixed; inset: 0; background: rgba(15,23,42,.6); z-index: 100; display: flex; align-items: center; justify-content: center; padding: 1rem; }
    .modal-card { background: #fff; border-radius: 1.5rem; width: 100%; max-width: 550px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden; animation: zoomIn .2s ease-out; }
    @keyframes zoomIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .modal-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; }
    .modal-title { font-size: 1.1rem; font-weight: 800; color: #1e293b; margin: 0; }
    .btn-close-modal { background: none; border: none; color: #94a3b8; font-size: 1.2rem; cursor: pointer; }
    
    .modal-form { padding: 1.5rem; }
    .form-group { margin-bottom: 1.25rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .form-group label { display: block; font-size: .8rem; font-weight: 700; color: #475569; margin-bottom: .5rem; }
    .form-group input, .form-group textarea { width: 100%; padding: .625rem 1rem; border: 1.5px solid #e2e8f0; border-radius: .625rem; font-size: .85rem; outline: none; transition: all .2s; box-sizing: border-box; }
    .form-group input:focus, .form-group textarea:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, .1); }
    .form-group input[type="file"] { padding: .5rem; font-size: .75rem; }

    .modal-footer { display: flex; justify-content: flex-end; gap: .75rem; margin-top: 2rem; }
    .btn-cancel { background: #fff; border: 1.5px solid #e2e8f0; color: #64748b; padding: .625rem 1.25rem; border-radius: .625rem; font-size: .85rem; font-weight: 700; cursor: pointer; }
    .btn-submit { background: #6366f1; border: none; color: #fff; padding: .625rem 1.25rem; border-radius: .625rem; font-size: .85rem; font-weight: 700; cursor: pointer; transition: all .2s; }
    .btn-submit:hover { background: #4f46e5; }

    .empty-state-card { background: #fff; border-radius: 1.5rem; padding: 4rem 1rem; text-align: center; border: 1px solid #f1f5f9; color: #cbd5e1; }
    .empty-state-card i { font-size: 3rem; margin-bottom: 1rem; display: block; }
    .empty-state-card p { font-size: .9rem; font-weight: 700; color: #94a3b8; }

    .hidden { display: none !important; }

    /* ── Alert ── */
    .alert-banner { display:flex;align-items:flex-start;justify-content:space-between;gap:.75rem;padding:.875rem 1.125rem;border-radius:.75rem;margin-bottom:1.5rem;font-size:.85rem;font-weight:600; }
    .alert-success { background:#f0fdf4;border:1px solid #bbf7d0;color:#166534; }
    .alert-inner { display:flex;align-items:flex-start;gap:.5rem; }
    .alert-banner button { background:none;border:none;cursor:pointer;color:inherit;opacity:.6; }

    @media (max-width: 600px) {
        .form-row { grid-template-columns: 1fr; }
        .toolbar-wrap { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .btn-primary { width: 100%; justify-content: center; }
    }
</style>

<script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }

    function editAlbum(album) {
        document.getElementById('edit-judul').value = album.judul;
        document.getElementById('edit-tanggal').value = album.tanggal || '';
        document.getElementById('edit-deskripsi').value = album.deskripsi || '';
        document.getElementById('form-edit').action = `{{ url('dokumentasi/album') }}/${album.id}`;
        toggleModal('modal-edit');
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
