<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpMail; // Mungkin tidak lagi digunakan untuk pengiriman, tapi tetap perlu jika view mail.otp masih ada
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Mungkin tidak lagi digunakan untuk pengiriman, tapi tetap perlu jika ada logika lain
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use PHPMailer\PHPMailer\PHPMailer; // Tambahkan ini
use PHPMailer\PHPMailer\Exception; // Tambahkan ini
use PHPMailer\PHPMailer\SMTP;     // Tambahkan ini

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
            $mail = new PHPMailer(true); // true enables exceptions

            // Pengaturan Debugging PHPMailer
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Aktifkan output debug lengkap di browser
            $mail->isSMTP();

            // ------- Konfigurasi untuk GMAIL SMTP (Gunakan App Password) -------
            // Pastikan Anda sudah membuat App Password untuk akun Gmail Anda
            // dan mengaturnya di file .env sebagai MAIL_USERNAME dan MAIL_PASSWORD
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME'); // Contoh: 'your_email@gmail.com'
            $mail->Password   = env('MAIL_PASSWORD'); // Contoh: 'your_app_password'
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Menggunakan TLS
            $mail->Port       = 587; // Port TLS
            // ------------------------------------------------------------------

            /*
            // ------- Alternatif Konfigurasi untuk MAILTRAP SMTP (Non-aktifkan Gmail di atas jika menggunakan ini) -------
            // Pastikan Anda sudah mengonfigurasi kredensial Mailtrap di file .env
            // atau langsung masukkan di sini (tidak disarankan untuk produksi)
            // $mail->Host       = 'sandbox.smtp.mailtrap.io'; // Host Mailtrap
            // $mail->SMTPAuth   = true;
            // $mail->Username   = 'YOUR_MAILTRAP_USERNAME'; // Ganti dengan user Mailtrap Anda
            // $mail->Password   = 'YOUR_MAILTRAP_PASSWORD'; // Ganti dengan password Mailtrap Anda
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Atau PHPMailer::ENCRYPTION_SMTPS untuk port 465
            // $mail->Port       = 587; // Port Mailtrap, bisa 2525, 465, 587
            // ---------------------------------------------------------------------------------------------------------
            */

            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS', 'no-reply@toko-faa.com'), env('MAIL_FROM_NAME', 'Toko FAA'));
            $mail->addAddress($request->email); // Alamat email penerima

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Verifikasi Akun FAA';
            // Render view blade untuk konten email
            $mail->Body    = view('mail.otp', ['otp' => $newOtp])->render();
            $mail->AltBody = 'Kode OTP Anda adalah: ' . $newOtp . '. Kode ini akan kedaluwarsa dalam 10 menit.';

            $mail->send();
            \Log::info('Email OTP berhasil dikirim ulang ke ' . $request->email);

        } catch (Exception $e) {
            \Log::error('Gagal mengirim ulang email OTP: ' . $e->getMessage() . ' PHPMailer Error: ' . $mail->ErrorInfo);

            // Tampilkan debug info PHPMailer langsung di browser
            echo "<h1>Error Pengiriman Email OTP!</h1>";
            echo "Pesan kesalahan: " . $e->getMessage();
            echo "<br>Detail Debug PHPMailer:<br>";
            echo "<pre>" . $mail->ErrorInfo . "</pre>"; // Debug info dari PHPMailer
            die(); // Hentikan eksekusi untuk menampilkan detail error
        }

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
