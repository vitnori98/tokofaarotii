<x-guest-layout>
    <style>
        .otp-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 15px 15px 35px rgba(0, 0, 0, 0.05), -10px -10px 30px rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(229, 9, 20, 0.05);
            transition: all 0.4s ease;
        }
        
        .otp-card:hover {
            transform: translateY(-5px);
            box-shadow: 20px 20px 45px rgba(229, 9, 20, 0.1);
        }

        .otp-input {
            letter-spacing: 12px;
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            border-radius: 12px !important;
            border: 2px solid #f1f1f1 !important;
            transition: all 0.3s ease;
            color: #dc3545;
            background: #fafafa !important;
        }

        .otp-input:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 15px rgba(220, 53, 69, 0.1) !important;
            background: #ffffff !important;
            transform: scale(1.02);
        }

        .btn-verify {
            background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%) !important;
            border: none !important;
            padding: 12px 30px !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            letter-spacing: 1px;
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3) !important;
            transition: all 0.3s ease !important;
        }

        .btn-verify:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 25px rgba(220, 53, 69, 0.4) !important;
        }

        .brand-logo {
            filter: drop-shadow(0 5px 10px rgba(220, 53, 69, 0.2));
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }
    </style>

    <div class="otp-card">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-black text-gray-800 mb-2">Verifikasi Email</h2>
            <div class="w-16 h-1 bg-red-600 mx-auto rounded-full mb-4"></div>
            <p class="text-sm text-gray-600">
                {{ __('Masukkan 6 digit kode OTP yang kami kirimkan ke alamat email Anda untuk mengaktifkan akun FAA.') }}
            </p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm font-semibold rounded-r-lg animate-pulse">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm font-semibold rounded-r-lg">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <input type="hidden" name="email" value="{{ $email }}">

            <!-- OTP Code -->
            <div class="mb-6">
                <label for="otp" class="block text-xs font-black text-red-600 uppercase tracking-widest mb-2 text-center">{{ __('Kode OTP') }}</label>
                <input id="otp" 
                       class="otp-input block w-full" 
                       type="text" 
                       name="otp" 
                       maxlength="6"
                       placeholder="000000"
                       required 
                       autofocus />
                <x-input-error :messages="$errors->get('otp')" class="mt-2 text-center" />
            </div>

            <div class="flex flex-col gap-4 mt-8">
                <button type="submit" class="btn-verify text-white w-full uppercase">
                    {{ __('Verifikasi Akun Sekarang') }}
                </button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col items-center gap-4">
            <form method="POST" action="{{ route('otp.resend') }}" class="w-full">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit" class="text-xs font-bold text-gray-400 hover:text-red-600 transition-colors flex items-center justify-center gap-2 mx-auto uppercase tracking-tighter">
                    <i class="bi bi-arrow-clockwise"></i> {{ __('Belum terima kode? Kirim Ulang') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-bold text-red-600 hover:underline uppercase tracking-tighter">
                    {{ __('Batal & Keluar') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
