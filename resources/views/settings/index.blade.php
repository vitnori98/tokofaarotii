@extends('layouts.app')

@section('title', 'Pengaturan Sistem')
@section('subtitle', 'Konfigurasi identitas toko dan preferensi sistem')

@section('content')

{{-- ── ALERT ── --}}
@if(session('success'))
<div class="alert-banner alert-success">
    <div class="alert-inner"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>
    <button onclick="this.closest('.alert-banner').remove()"><i class="fas fa-times"></i></button>
</div>
@endif

<div class="settings-container">
    <div class="settings-grid">
        
        {{-- ── NAVIGATION SIDEBAR (Internal) ── --}}
        <div class="settings-nav">
            <div class="nav-card">
                <a href="#general" class="nav-item active">
                    <i class="fas fa-store"></i>
                    <span>Informasi Toko</span>
                </a>
                <a href="#branding" class="nav-item">
                    <i class="fas fa-palette"></i>
                    <span>Tampilan & Branding</span>
                </a>
                <a href="#security" class="nav-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Keamanan</span>
                </a>
                <a href="#system" class="nav-item">
                    <i class="fas fa-server"></i>
                    <span>Sistem</span>
                </a>
            </div>
            
            <div class="nav-info-card">
                <i class="fas fa-info-circle"></i>
                <p>Pengaturan ini berlaku untuk seluruh sistem. Pastikan data yang dimasukkan sudah benar.</p>
            </div>
        </div>

        {{-- ── FORM CONTENT ── --}}
        <div class="settings-content">
            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf

                {{-- SECTION: GENERAL --}}
                <div id="general" class="content-section">
                    <div class="section-header">
                        <h3 class="section-title">Informasi Toko</h3>
                        <p class="section-desc">Atur identitas dasar bisnis Frozen & Bakery Anda.</p>
                    </div>

                    <div class="section-card">
                        <div class="form-group">
                            <label class="form-label">Nama Toko</label>
                            <input type="text" name="store_name" class="form-input" 
                                   value="{{ old('store_name', 'Toko Faa Frozen & Bakery') }}" 
                                   placeholder="Contoh: Toko Faa Frozen">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nomor Telepon / WhatsApp</label>
                                <div class="input-with-icon">
                                    <i class="fab fa-whatsapp"></i>
                                    <input type="text" name="store_phone" class="form-input icon-padded" 
                                           value="{{ old('store_phone', '0812-3456-7890') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Kontak</label>
                                <div class="input-with-icon">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" name="store_email" class="form-input icon-padded" 
                                           value="{{ old('store_email', 'kontak@tokofaa.com') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="store_address" class="form-input" rows="3" 
                                      placeholder="Jl. Raya Utama No. 123...">{{ old('store_address', 'Jl. Contoh Alamat No. 10, Kota Bangka') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SECTION: BRANDING --}}
                <div id="branding" class="content-section">
                    <div class="section-header">
                        <h3 class="section-title">Tampilan & Branding</h3>
                        <p class="section-desc">Kustomisasi logo dan elemen visual struk belanja.</p>
                    </div>

                    <div class="section-card">
                        <div class="logo-upload-wrap">
                            <div class="logo-preview">
                                <i class="fas fa-bread-slice"></i>
                            </div>
                            <div class="logo-info">
                                <label class="form-label">Logo Toko</label>
                                <input type="file" name="store_logo" class="file-input">
                                <p class="file-hint">Format: PNG, JPG (Maks. 2MB). Rekomendasi: Persegi (1:1)</p>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label class="form-label">Pesan Header Struk</label>
                            <input type="text" name="receipt_header" class="form-input" 
                                   value="{{ old('receipt_header', 'Terima Kasih Telah Berbelanja!') }}">
                        </div>
                    </div>
                </div>

                <div class="form-actions-bar">
                    <button type="reset" class="btn-reset">Reset Perubahan</button>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Simpan Semua Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<style>
    .settings-container { max-width: 1100px; margin: 0 auto; }
    .settings-grid { display: grid; grid-template-columns: 280px 1fr; gap: 2rem; align-items: start; }

    /* ── Sidebar Nav ── */
    .nav-card { background: #fff; border-radius: 1.25rem; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
    .nav-item { display: flex; align-items: center; gap: .875rem; padding: 1rem 1.25rem; text-decoration: none; color: #64748b; font-size: .85rem; font-weight: 700; transition: all .2s; border-left: 3px solid transparent; }
    .nav-item i { font-size: 1rem; width: 20px; text-align: center; }
    .nav-item:hover { background: #f8fafc; color: #f97316; }
    .nav-item.active { background: #fff7ed; color: #f97316; border-left-color: #f97316; }

    .nav-info-card { margin-top: 1.5rem; padding: 1.25rem; background: #fff7ed; border: 1px solid #ffedd5; border-radius: 1.25rem; display: flex; gap: .75rem; }
    .nav-info-card i { color: #f97316; font-size: 1rem; margin-top: 2px; }
    .nav-info-card p { margin: 0; font-size: .75rem; color: #9a3412; font-weight: 600; line-height: 1.5; }

    /* ── Content Sections ── */
    .content-section { margin-bottom: 3rem; scroll-margin-top: 2rem; }
    .section-header { margin-bottom: 1.25rem; }
    .section-title { font-size: 1.1rem; font-weight: 800; color: #1e293b; margin: 0 0 .25rem; }
    .section-desc { font-size: .85rem; color: #64748b; margin: 0; }

    .section-card { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; padding: 1.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
    
    .form-group { margin-bottom: 1.5rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    .form-label { display: block; font-size: .8rem; font-weight: 700; color: #475569; margin-bottom: .625rem; text-transform: uppercase; letter-spacing: .05em; }
    
    .form-input { width: 100%; padding: .75rem 1rem; border: 2px solid #f1f5f9; border-radius: .875rem; font-size: .9rem; font-weight: 500; color: #1e293b; transition: all .2s; box-sizing: border-box; }
    .form-input:focus { border-color: #f97316; outline: none; background: #fff; box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.08); }
    
    .input-with-icon { position: relative; }
    .input-with-icon i { position: absolute; left: 1.125rem; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: .9rem; }
    .icon-padded { padding-left: 2.75rem; }

    /* ── Logo Upload ── */
    .logo-upload-wrap { display: flex; align-items: center; gap: 1.5rem; }
    .logo-preview { width: 80px; height: 80px; background: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 1.25rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: #cbd5e1; }
    .file-input { font-size: .8rem; color: #64748b; }
    .file-hint { font-size: .7rem; color: #94a3b8; margin: 4px 0 0; }

    /* ── Actions Bar ── */
    .form-actions-bar { position: sticky; bottom: 2rem; background: #fff; border: 1px solid #f1f5f9; padding: 1.25rem 2rem; border-radius: 1.5rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 30px rgba(0,0,0,0.08); z-index: 20; margin-top: 2rem; }
    .btn-reset { background: none; border: none; font-size: .85rem; font-weight: 700; color: #94a3b8; cursor: pointer; transition: color .2s; }
    .btn-reset:hover { color: #ef4444; }
    .btn-save { background: #f97316; color: #fff; border: none; padding: .875rem 2rem; border-radius: 1rem; font-size: .95rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: .75rem; transition: all .2s; }
    .btn-save:hover { background: #ea580c; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(249, 115, 22, 0.2); }

    /* ── Alert ── */
    .alert-banner { display:flex;align-items:flex-start;justify-content:space-between;gap:.75rem;padding:.875rem 1.125rem;border-radius:.75rem;margin-bottom:2rem;font-size:.85rem;font-weight:600; }
    .alert-success { background:#f0fdf4;border:1px solid #bbf7d0;color:#166534; }
    .alert-inner { display:flex;align-items:flex-start;gap:.5rem; }
    .alert-banner button { background:none;border:none;cursor:pointer;color:inherit;opacity:.6; }

    @media (max-width: 900px) {
        .settings-grid { grid-template-columns: 1fr; }
        .settings-nav { display: none; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>

<script>
    // Simple scroll spy / active nav handling
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

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
