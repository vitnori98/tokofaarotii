@extends('layouts.app')

@section('title', 'Video Dokumentasi')
@section('subtitle', 'Koleksi video kegiatan dan promosi Toko Faa')

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
        <h3 class="toolbar-title">Galeri Video</h3>
    </div>
    <div class="toolbar-right">
        <button onclick="toggleModal('modal-tambah')" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Video
        </button>
    </div>
</div>

{{-- ── GRID VIDEO ── --}}
@if($videos->isEmpty())
    <div class="empty-state-card">
        <i class="fas fa-video"></i>
        <p>Belum ada koleksi video</p>
    </div>
@else
    <div class="video-grid">
        @foreach($videos as $video)
        <div class="video-card">
            <div class="video-embed-wrap">
                @php
                    $embedUrl = str_replace('watch?v=', 'embed/', $video->url);
                    if (str_contains($embedUrl, 'youtu.be/')) {
                        $embedUrl = str_replace('youtu.be/', 'youtube.com/embed/', $embedUrl);
                    }
                @endphp
                <iframe src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="video-body">
                <h4 class="video-title">{{ $video->judul }}</h4>
                <p class="video-desc">{{ Str::limit($video->deskripsi, 100) }}</p>
                <div class="video-footer">
                    <div class="video-actions">
                        <button onclick="editVideo({{ json_encode($video) }})" class="btn-icon-sm btn-amber" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('dokumentasi.video.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Hapus video ini?')" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon-sm btn-red" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

{{-- ── MODAL TAMBAH ── --}}
<div id="modal-tambah" class="modal-overlay hidden">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Video</h3>
            <button onclick="toggleModal('modal-tambah')" class="btn-close-modal"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('dokumentasi.video.store') }}" method="POST" class="modal-form">
            @csrf
            <div class="form-group">
                <label>Judul Video</label>
                <input type="text" name="judul" required placeholder="Contoh: Profil Toko Faa 2024">
            </div>
            <div class="form-group">
                <label>URL Video (YouTube)</label>
                <input type="url" name="url" required placeholder="https://www.youtube.com/watch?v=...">
            </div>
            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" placeholder="Apa isi video ini?"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="toggleModal('modal-tambah')" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-submit">Simpan Video</button>
            </div>
        </form>
    </div>
</div>

{{-- ── MODAL EDIT ── --}}
<div id="modal-edit" class="modal-overlay hidden">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title">Edit Video</h3>
            <button onclick="toggleModal('modal-edit')" class="btn-close-modal"><i class="fas fa-times"></i></button>
        </div>
        <form id="form-edit" method="POST" class="modal-form">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Judul Video</label>
                <input type="text" name="judul" id="edit-judul" required>
            </div>
            <div class="form-group">
                <label>URL Video (YouTube)</label>
                <input type="url" name="url" id="edit-url" required>
            </div>
            <div class="form-group">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" id="edit-deskripsi" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="toggleModal('modal-edit')" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-submit">Update Video</button>
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
    .video-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2rem; }
    .video-card { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 1px 3px rgba(15,23,42,.05); transition: all .3s; }
    .video-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(15,23,42,.1); }
    
    .video-embed-wrap { width: 100%; aspect-ratio: 16/9; background: #000; }
    .video-embed-wrap iframe { width: 100%; height: 100%; }

    .video-body { padding: 1.5rem; }
    .video-title { font-size: 1.1rem; font-weight: 800; color: #1e293b; margin: 0 0 .75rem; line-height: 1.4; }
    .video-desc { font-size: .85rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem; }

    .video-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f8fafc; padding-top: 1rem; }
    .video-actions { display: flex; align-items: center; gap: .5rem; }
    .btn-icon-sm { width: 34px; height: 34px; border-radius: .625rem; display: flex; align-items: center; justify-content: center; font-size: .8rem; border: none; cursor: pointer; transition: all .2s; }
    .btn-amber { background: #fffbeb; color: #d97706; }
    .btn-amber:hover { background: #d97706; color: #fff; }
    .btn-red { background: #fef2f2; color: #ef4444; }
    .btn-red:hover { background: #ef4444; color: #fff; }

    /* ── Modal (Sama dengan sebelumnya) ── */
    .modal-overlay { position: fixed; inset: 0; background: rgba(15,23,42,.6); z-index: 100; display: flex; align-items: center; justify-content: center; padding: 1rem; }
    .modal-card { background: #fff; border-radius: 1.5rem; width: 100%; max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden; animation: zoomIn .2s ease-out; }
    @keyframes zoomIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .modal-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; }
    .modal-title { font-size: 1.1rem; font-weight: 800; color: #1e293b; margin: 0; }
    .btn-close-modal { background: none; border: none; color: #94a3b8; font-size: 1.2rem; cursor: pointer; }
    
    .modal-form { padding: 1.5rem; }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label { display: block; font-size: .8rem; font-weight: 700; color: #475569; margin-bottom: .5rem; }
    .form-group input, .form-group textarea { width: 100%; padding: .625rem 1rem; border: 1.5px solid #e2e8f0; border-radius: .625rem; font-size: .85rem; outline: none; transition: all .2s; box-sizing: border-box; }
    .form-group input:focus, .form-group textarea:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, .1); }

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
        .video-grid { grid-template-columns: 1fr; }
    }
</style>

<script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }

    function editVideo(video) {
        document.getElementById('edit-judul').value = video.judul;
        document.getElementById('edit-url').value = video.url;
        document.getElementById('edit-deskripsi').value = video.deskripsi || '';
        document.getElementById('form-edit').action = `{{ url('dokumentasi/video') }}/${video.id}`;
        toggleModal('modal-edit');
    }

    setTimeout(() => {
        document.querySelectorAll('.alert-banner').forEach(el => {
            el.style.transition = 'opacity .4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        });
    }, 4000);
</script>

@endsection
