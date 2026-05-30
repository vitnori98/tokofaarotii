<x-guest-layout>
    <div class="form-header">
        <h2 class="form-title">Selamat Datang!</h2>
        <p class="form-subtitle">Silakan masuk ke akun Anda untuk melanjutkan.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="auth-input-group">
            <label class="auth-label">Email Address</label>
            <div class="auth-input-wrap">
                <i class="fas fa-envelope auth-input-icon"></i>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="auth-input" placeholder="admin@tokofaa.com">
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
                <input type="password" name="password" required class="auth-input" placeholder="••••••••">
            </div>
            @if($errors->has('password'))
                <span class="auth-error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="auth-footer-links">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ms-2 text-sm font-semibold text-gray-600">Ingat Saya</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-auth-submit">
            <span>Masuk Sekarang</span>
            <i class="fas fa-arrow-right"></i>
        </button>

        <div class="divider">
            <span>Atau</span>
        </div>

        <p class="text-center text-sm font-semibold text-gray-500">
            Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar Gratis</a>
        </p>
    </form>
</x-guest-layout>
