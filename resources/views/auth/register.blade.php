<x-guest-layout>
    <div class="form-header">
        <h2 class="form-title">Daftar Akun</h2>
        <p class="form-subtitle">Buat akun untuk mulai mengelola Toko Faa.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="auth-input-group">
            <label class="auth-label">Nama Lengkap</label>
            <div class="auth-input-wrap">
                <i class="fas fa-user auth-input-icon"></i>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="auth-input" placeholder="Masukkan nama Anda">
            </div>
            @if($errors->has('name'))
                <span class="auth-error">{{ $errors->first('name') }}</span>
            @endif
        </div>

        {{-- Email --}}
        <div class="auth-input-group">
            <label class="auth-label">Email Address</label>
            <div class="auth-input-wrap">
                <i class="fas fa-envelope auth-input-icon"></i>
                <input type="email" name="email" value="{{ old('email') }}" required class="auth-input" placeholder="contoh@tokofaa.com">
            </div>
            @if($errors->has('email'))
                <span class="auth-error">{{ $errors->first('email') }}</span>
            @endif
        </div>

        {{-- Password --}}
        <div class="auth-input-group">
            <label class="auth-label">Password</label>
            <div class="auth-input-wrap">
                <i class="fas fa-lock auth-input-icon"></i>
                <input type="password" name="password" required class="auth-input" placeholder="Minimal 8 karakter">
            </div>
            @if($errors->has('password'))
                <span class="auth-error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        {{-- Confirm Password --}}
        <div class="auth-input-group">
            <label class="auth-label">Konfirmasi Password</label>
            <div class="auth-input-wrap">
                <i class="fas fa-shield-alt auth-input-icon"></i>
                <input type="password" name="password_confirmation" required class="auth-input" placeholder="Ketik ulang password">
            </div>
        </div>

        <button type="submit" class="btn-auth-submit">
            <span>Daftar Sekarang</span>
            <i class="fas fa-user-plus"></i>
        </button>

        <div class="divider">
            <span>Atau</span>
        </div>

        <p class="text-center text-sm font-semibold text-gray-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk Disini</a>
        </p>
    </form>
</x-guest-layout>
