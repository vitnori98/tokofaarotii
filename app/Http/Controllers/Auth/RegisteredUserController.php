<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpMail; // Menggunakan Mailable yang sudah ada
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // Menggunakan facade Mail Laravel
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpExpiresAt = \Carbon\Carbon::now()->addMinutes(10);

        // Simpan data pendaftaran sementara di session
        session([
            'registration_data' => [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role' => 'user', // Role default untuk pengguna baru
                'otp' => $otp,
                'otp_expires_at' => $otpExpiresAt->timestamp, // Simpan sebagai timestamp
            ]
        ]);

        try {
            // Kirim email OTP menggunakan Laravel Mail
            \Illuminate\Support\Facades\Mail::to($validatedData['email'])->send(new OtpMail($otp));
            \Log::info('Email OTP berhasil dikirim ke ' . $validatedData['email']);

        } catch (\Exception $e) {
            // Jika email gagal, hapus data session dan kembalikan error
            session()->forget('registration_data');
            \Log::error('Gagal mengirim email OTP saat pendaftaran: ' . $e->getMessage());

            // Tampilkan pesan error langsung di browser untuk debugging lokal
            return back()->withInput()->withErrors(['email' => 'Gagal mengirim email OTP. Silakan cek koneksi internet atau pengaturan SMTP di file .env Anda. Error: ' . $e->getMessage()]);
        }

        // Arahkan ke halaman verifikasi OTP
        return redirect()->route('otp.verify.show', ['email' => $validatedData['email']])
            ->with('status', 'Silakan cek email Anda untuk kode OTP verifikasi.');
    }
}
