<x-guest-layout>
    <div class="form-header">
        <h2 class="form-title">Lupa Password?</h2>
        <p class="form-subtitle">Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan tautan reset.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-100">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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

        <button type="submit" class="btn-auth-submit">
            <span>Kirim Tautan Reset</span>
            <i class="fas fa-paper-plane"></i>
        </button>

        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="auth-link">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
