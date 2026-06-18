@extends('layouts.app')

@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi identitas dan keamanan akun Anda')

@section('content')

{{-- ── ALERT ── --}}
@if(session('status'))
<div class="alert-banner alert-success">
    <div class="alert-inner"><i class="fas fa-check-circle"></i><span>{{ session('status') }}</span></div>
    <button onclick="this.closest('.alert-banner').remove()"><i class="fas fa-times"></i></button>
@endif

@if($errors->any())
<div class="alert-banner alert-danger">
    <div class="alert-inner">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="margin:0; padding-left:1rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button onclick="this.closest('.alert-banner').remove()"><i class="fas fa-times"></i></button>
</div>
@endif

<div class="profile-container">
    <div class="profile-grid">
        
        {{-- ── PROFILE CARD ── --}}
        <div class="profile-sidebar">
            <div class="user-card">
                <div class="user-avatar-large">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <h3 class="user-name">{{ auth()->user()->name }}</h3>
                <p class="user-role">
                    @php
                        $roles = [
                            'admin_master' => 'Admin Utama',
                            'pemilik' => 'Pemilik',
                            'pegawai' => 'Pegawai'
                        ];
                    @endphp
                    {{ $roles[auth()->user()->role] ?? ucwords(str_replace('_', ' ', auth()->user()->role)) }}
                </p>
                <div class="user-meta">
                    <div class="meta-item">
                        <i class="far fa-envelope"></i>
                        <span>{{ auth()->user()->email }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="far fa-calendar-alt"></i>
                        <span>Bergabung {{ auth()->user()->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="nav-info-card">
                <i class="fas fa-shield-alt"></i>
                <p>Pastikan Anda menggunakan kata sandi yang kuat dan tidak membagikan akses akun kepada orang lain.</p>
            </div>
        </div>

        {{-- ── FORMS ── --}}
        <div class="profile-forms">
            
            {{-- Update Profile Information --}}
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">Informasi Profil</h3>
                    <p class="section-desc">Perbarui informasi dasar akun dan alamat email Anda.</p>
                </div>
                
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Simpan Profil
                        </button>
                    </div>
                </form>
            </div>

            {{-- Update Password --}}
            <div class="section-card mt-6">
                <div class="section-header">
                    <h3 class="section-title">Ubah Kata Sandi</h3>
                    <p class="section-desc">Ganti kata sandi secara berkala untuk menjaga keamanan akun.</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label class="form-label">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" class="form-input" placeholder="••••••••">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kata Sandi Baru</label>
                            <input type="password" name="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save btn-orange">
                            <i class="fas fa-key"></i> Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    .profile-container { max-width: 1000px; margin: 0 auto; }
    .profile-grid { display: grid; grid-template-columns: 320px 1fr; gap: 2rem; align-items: start; }

    /* ── Sidebar Card ── */
    .user-card { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; padding: 2rem; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
    .user-avatar-large { width: 80px; height: 80px; background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 800; margin: 0 auto 1.25rem; box-shadow: 0 8px 16px rgba(249, 115, 22, 0.2); }
    .user-name { font-size: 1.25rem; font-weight: 800; color: #1e293b; margin: 0 0 .25rem; }
    .user-role { font-size: .85rem; font-weight: 700; color: #f97316; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 1.5rem; }
    
    .user-meta { border-top: 1px solid #f1f5f9; padding-top: 1.5rem; display: flex; flex-direction: column; gap: .75rem; text-align: left; }
    .meta-item { display: flex; align-items: center; gap: .75rem; color: #64748b; font-size: .85rem; font-weight: 500; }
    .meta-item i { font-size: 1rem; color: #94a3b8; width: 20px; text-align: center; }

    .nav-info-card { margin-top: 1.5rem; padding: 1.25rem; background: #fff7ed; border: 1px solid #ffedd5; border-radius: 1.25rem; display: flex; gap: .75rem; }
    .nav-info-card i { color: #f97316; font-size: 1rem; margin-top: 2px; }
    .nav-info-card p { margin: 0; font-size: .75rem; color: #9a3412; font-weight: 600; line-height: 1.5; }

    /* ── Form Cards ── */
    .section-card { background: #fff; border-radius: 1.5rem; border: 1px solid #f1f5f9; padding: 1.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
    .mt-6 { margin-top: 1.5rem; }
    
    .section-header { margin-bottom: 1.5rem; }
    .section-title { font-size: 1.1rem; font-weight: 800; color: #1e293b; margin: 0 0 .25rem; }
    .section-desc { font-size: .85rem; color: #64748b; margin: 0; }

    .form-group { margin-bottom: 1.25rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .form-label { display: block; font-size: .8rem; font-weight: 700; color: #475569; margin-bottom: .5rem; text-transform: uppercase; letter-spacing: .05em; }
    
    .form-input { width: 100%; padding: .75rem 1rem; border: 2px solid #f1f5f9; border-radius: .875rem; font-size: .9rem; font-weight: 500; color: #1e293b; transition: all .2s; box-sizing: border-box; }
    .form-input:focus { border-color: #f97316; outline: none; background: #fff; box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.08); }

    .form-actions { display: flex; justify-content: flex-end; margin-top: 1.5rem; }
    .btn-save { background: #f97316; color: #fff; border: none; padding: .75rem 1.5rem; border-radius: .875rem; font-size: .9rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: .625rem; transition: all .2s; }
    .btn-save:hover { background: #ea580c; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(249, 115, 22, 0.2); }
    
    /* ── Alert ── */
    .alert-banner { display:flex;align-items:flex-start;justify-content:space-between;gap:.75rem;padding:.875rem 1.125rem;border-radius:.75rem;margin-bottom:2rem;font-size:.85rem;font-weight:600; }
    .alert-success { background:#f0fdf4;border:1px solid #bbf7d0;color:#166534; }
    .alert-danger { background:#fef2f2;border:1px solid #fee2e2;color:#991b1b; }
    .alert-inner { display:flex;align-items:flex-start;gap:.5rem; }
    .alert-banner button { background:none;border:none;cursor:pointer;color:inherit;opacity:.6; }

    @media (max-width: 900px) {
        .profile-grid { grid-template-columns: 1fr; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>

<script>
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