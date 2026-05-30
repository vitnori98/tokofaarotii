<x-guest-layout>
    <div class="form-header">
        <h2 class="form-title">Verifikasi Email</h2>
        <p class="form-subtitle">Terima kasih telah mendaftar! Silakan verifikasi alamat email Anda melalui tautan yang kami kirimkan.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-100">
            Tautan verifikasi baru telah dikirim ke alamat email Anda.
        </div>
    @endif

    <div class="mt-4 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-auth-submit">
                <span>Kirim Ulang Email Verifikasi</span>
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="auth-link font-bold border-none bg-transparent cursor-pointer">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
