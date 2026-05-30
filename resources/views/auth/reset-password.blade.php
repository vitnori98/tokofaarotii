<x-guest-layout>
    <div class="form-header">
        <h2 class="form-title">Reset Password</h2>
        <p class="form-subtitle">Buat password baru untuk mengamankan akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email --}}
        <div class="auth-input-group">
            <label class="auth-label">Email Address</label>
            <div class="auth-input-wrap">
                <i class="fas fa-envelope auth-input-icon"></i>
                <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="auth-input">
            </div>
            @if($errors->has('email'))
                <span class="auth-error">{{ $errors->first('email') }}</span>
            @endif
        </div>

        {{-- Password --}}
        <div class="auth-input-group">
            <label class="auth-label">Password Baru</label>
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
            <label class="auth-label">Konfirmasi Password Baru</label>
            <div class="auth-input-wrap">
                <i class="fas fa-shield-alt auth-input-icon"></i>
                <input type="password" name="password_confirmation" required class="auth-input" placeholder="Ketik ulang password">
            </div>
            @if($errors->has('password_confirmation'))
                <span class="auth-error">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button type="submit" class="btn-auth-submit">
            <span>Simpan Password Baru</span>
            <i class="fas fa-key"></i>
        </button>
    </form>
</x-guest-layout>
