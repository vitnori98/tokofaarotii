@extends('layouts.app')

@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi biodata pribadi dan keamanan akun Anda')

@section('content')

{{-- ── ALERT NOTIFIKASI ── --}}
@if(session('success'))
<div class="alert-banner alert-success">
    <div class="alert-inner"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>
    <button onclick="this.closest('.alert-banner').remove()"><i class="fas fa-times"></i></button>
</div>
@endif

@if($errors->any())
<div class="alert-banner" style="background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b;">
    <div class="alert-inner">
        <i class="fas fa-exclamation-circle" style="margin-top: 3px;"></i>
        <ul style="list-style: disc; padding-left: 1rem; margin: 0;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="settings-container">
    <div class="settings-grid">
        
        {{-- ── NAVIGATION SIDEBAR (TAB SWITCHER) ── --}}
        <div class="settings-nav">
            <div class="nav-card">
                <button onclick="switchProfileTab('personal-info')" id="btn-personal-info" class="nav-item-btn active">
                    <i class="fas fa-user-circle"></i>
                    <span>Biodata Profil</span>
                </button>
                <button onclick="switchProfileTab('address-info')" id="btn-address-info" class="nav-item-btn">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Alamat & Lokasi</span>
                </button>
                <button onclick="switchProfileTab('security-info')" id="btn-security-info" class="nav-item-btn">
                    <i class="fas fa-key"></i>
                    <span>Keamanan Akun</span>
                </button>
            </div>
            
            <div class="nav-info-card">
                <i class="fas fa-shield-alt"></i>
                <p>Data profil ini bersifat rahasia. Pastikan Anda memperbarui informasi dengan data yang valid.</p>
            </div>
        </div>

        {{-- ── FORM CONTENT PRIVAT USER ── --}}
        <div class="settings-content">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                {{-- SECTION 1: BIODATA PROFIL --}}
                <div id="personal-info" class="content-section">
                    <div class="section-header">
                        <h3 class="section-title">Biodata Profil</h3>
                        <p class="section-desc">Atur nama, email login, serta informasi kontak pribadi Anda.</p>
                    </div>

                    <div class="section-card">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-input" 
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email Login</label>
                                <div class="input-with-icon">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" name="email" class="form-input icon-padded" 
                                           value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nomor HP / WhatsApp</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-phone-alt"></i>
                                    <input type="text" name="phone_number" class="form-input icon-padded" 
                                           value="{{ old('phone_number', $user->phone_number ?? '') }}" placeholder="Contoh: 0812345678">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <div style="display: flex; gap: 2rem; margin-top: 0.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 600; color: #1e293b; cursor: pointer;">
                                    <input type="radio" name="gender" value="Laki-laki" {{ old('gender', $user->gender ?? '') == 'Laki-laki' ? 'checked' : '' }} style="accent-color: #f97316;"> Laki-laki
                                </label>
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 600; color: #1e293b; cursor: pointer;">
                                    <input type="radio" name="gender" value="Perempuan" {{ old('gender', $user->gender ?? '') == 'Perempuan' ? 'checked' : '' }} style="accent-color: #f97316;"> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: ALAMAT & LOKASI --}}
                <div id="address-info" class="content-section d-none">
                    <div class="section-header">
                        <h3 class="section-title">Alamat & Lokasi</h3>
                        <p class="section-desc">Tentukan lokasi pengantaran utama untuk mempermudah operasional pesanan.</p>
                    </div>

                    <div class="section-card">
                        <div class="form-group">
                            <label class="form-label">Kota / Kabupaten</label>
                            <input type="text" name="city" class="form-input" 
                                   value="{{ old('city', $user->city ?? '') }}" placeholder="Contoh: Kota Bangka">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" class="form-input" rows="4" 
                                      placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan...">{{ old('address', $user->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: KEAMANAN AKUN --}}
                <div id="security-info" class="content-section d-none">
                    <div class="section-header">
                        <h3 class="section-title">Keamanan Akun</h3>
                        <p class="section-desc">Ganti password secara berkala untuk menjaga keamanan data akun Anda.</p>
                    </div>

                    <div class="section-card">
                        <div class="form-group">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-input" placeholder="••••••••">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="new_password" class="form-input" placeholder="Minimal 8 karakter">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-input" placeholder="Ulangi password baru">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BAR ACTION ACTION BUTTON --}}
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

{{-- ── TAMBAHAN STYLING COMPATIBILITY ── --}}
<style>
    /* Styling tombol Navigasi agar identik dengan desain setelan CSS bawaan Anda */
    .nav-item-btn { 
        display: flex; 
        align-items: center; 
        gap: .875rem; 
        padding: 1rem 1.25rem; 
        color: #64748b; 
        font-size: .85rem; 
        font-weight: 700; 
        transition: all .2s; 
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        border-left: 3px solid transparent; 
    }
    .nav-item-btn i { font-size: 1rem; width: 20px; text-align: center; }
    .nav-item-btn:hover { background: #f8fafc; color: #f97316; }
    .nav-item-btn.active { background: #fff7ed; color: #f97316; border-left-color: #f97316; }

    /* Helper Class Sembunyikan Section */
    .d-none { display: none !important; }
</style>

{{-- ── JAVASCRIPT SWITCHER TANPA RELOAD ── --}}
<script>
    function switchProfileTab(tabId) {
        // 1. Sembunyikan seluruh section konten form profil
        document.querySelectorAll('.content-section').forEach(section => {
            section.classList.add('d-none');
        });

        // 2. Tampilkan section tab yang aktif dipilih
        document.getElementById(tabId).classList.remove('d-none');

        // 3. Matikan status active dari semua button sidebar
        document.querySelectorAll('.nav-item-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // 4. Nyalakan status active pada button yang sedang di-klik
        document.getElementById('btn-' + tabId).classList.add('active');
    }

    // Auto dismiss alert bawaan sistem Anda
    setTimeout(() => {
        document.querySelectorAll('.alert-banner').forEach(el => {
            el.style.transition = 'opacity .4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        });
    }, 4000);
</script>

@endsection