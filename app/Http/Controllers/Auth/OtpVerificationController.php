<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpMail; // Menggunakan Mailable yang sudah ada
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Menggunakan facade Mail Laravel
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;

class OtpVerificationController extends Controller
{
    /**
     * Display the OTP verification view.
     */
    public function showVerificationForm(Request $request): View|RedirectResponse
    {
        // Pastikan ada email di parameter URL atau session
        $email = $request->query('email') ?? session('registration_data.email');

        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'Sesi pendaftaran tidak ditemukan. Silakan daftar ulang.']);
        }

        // Periksa apakah data pendaftaran sementara ada di session
        if (!session()->has('registration_data')) {
            return redirect()->route('register')->withErrors(['email' => 'Sesi pendaftaran telah kedaluwarsa atau tidak ditemukan.']);
        }

        // Pastikan email di session cocok dengan email di request
        if (session('registration_data.email') !== $email) {
            session()->forget('registration_data');
            return redirect()->route('register')->withErrors(['email' => 'Email di sesi tidak cocok. Silakan daftar ulang.']);
        }

        return view('auth.verify-otp', ['email' => $email]);
    }

    /**
     * Handle an incoming OTP verification request.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'otp' => ['required', 'string', 'min:6', 'max:6'],
        ]);

        $registrationData = session('registration_data');

        // Pastikan data pendaftaran ada dan email cocok
        if (!$registrationData || $registrationData['email'] !== $request->email) {
            session()->forget('registration_data');
            return back()->withErrors(['otp' => 'Sesi verifikasi OTP tidak valid atau telah kedaluwarsa. Silakan daftar ulang.']);
        }

        $storedOtp = $registrationData['otp'];
        $otpExpiresAt = Carbon::createFromTimestamp($registrationData['otp_expires_at']);

        // Periksa OTP dan waktu kedaluwarsa
        if ($request->otp !== $storedOtp || Carbon::now()->greaterThan($otpExpiresAt)) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau telah kedaluwarsa.']);
        }

        // Jika OTP valid, buat pengguna
        try {
            $user = User::create([
                'name' => $registrationData['name'],
                'email' => $registrationData['email'],
                'password' => $registrationData['password'], // Password sudah di-hash di RegisteredUserController
                'role' => $registrationData['role'],
                'email_verified_at' => Carbon::now(), // Verifikasi email dianggap berhasil setelah OTP
            ]);

            // Hapus data pendaftaran dari session
            session()->forget('registration_data');

            // Autentikasi pengguna
            Auth::login($user);

            event(new Registered($user)); // Trigger event setelah user terdaftar dan terverifikasi

            return redirect()->intended(route('dashboard', absolute: false))->with('success', 'Akun Anda berhasil didaftarkan dan diverifikasi!');

        } catch (\Exception $e) {
            \Log::error('Error creating user after OTP verification: ' . $e->getMessage());
            session()->forget('registration_data'); // Hapus data session jika ada error pembuatan user
            return back()->withErrors(['otp' => 'Gagal membuat akun setelah verifikasi OTP. Silakan coba daftar ulang.']);
        }
    }

    /**
     * Resend OTP.
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $registrationData = session('registration_data');

        if (!$registrationData || $registrationData['email'] !== $request->email) {
            return back()->withErrors(['email' => 'Sesi pendaftaran tidak valid atau telah kedaluwarsa. Silakan daftar ulang.']);
        }
        
        // Periksa apakah pengiriman ulang terlalu cepat (misal: 1 menit antar pengiriman)
        $lastResend = session('otp_last_resend_time');
        if ($lastResend && Carbon::createFromTimestamp($lastResend)->addMinutes(1)->greaterThan(Carbon::now())) {
            return back()->with('error', 'Silakan tunggu sebentar sebelum meminta OTP baru.');
        }


        $newOtp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $newOtpExpiresAt = Carbon::now()->addMinutes(10);

        // Perbarui OTP di session
        $registrationData['otp'] = $newOtp;
        $registrationData['otp_expires_at'] = $newOtpExpiresAt->timestamp;
        session([
            'registration_data' => $registrationData,
            'otp_last_resend_time' => Carbon::now()->timestamp
        ]);

        try {
            // Kirim ulang email OTP menggunakan Laravel Mail
            \Illuminate\Support\Facades\Mail::to($request->email)->send(new OtpMail($newOtp));
            \Log::info('Email OTP berhasil dikirim ulang ke ' . $request->email);

        } catch (\Exception $e) {
            \Log::error('Gagal mengirim ulang email OTP: ' . $e->getMessage());

            // Tampilkan pesan error langsung di browser untuk debugging lokal
            return back()->withInput()->withErrors(['email' => 'Gagal mengirim ulang email OTP. Silakan cek koneksi internet atau pengaturan SMTP di file .env Anda. Error: ' . $e->getMessage()]);
        }

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
