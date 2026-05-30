<x-guest-layout>
    <div class="form-header">
        <h2 class="form-title">Konfirmasi Password</h2>
        <p class="form-subtitle">Ini adalah area aman aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        {{-- Password --}}
        <div class="auth-input-group">
            <label class="auth-label">Password Anda</label>
            <div class="auth-input-wrap">
                <i class="fas fa-lock auth-input-icon"></i>
                <input type="password" name="password" required class="auth-input" placeholder="••••••••">
            </div>
            @if($errors->has('password'))
                <span class="auth-error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button type="submit" class="btn-auth-submit">
            <span>Konfirmasi & Lanjutkan</span>
            <i class="fas fa-check-circle"></i>
        </button>
    </form>
</x-guest-layout>
