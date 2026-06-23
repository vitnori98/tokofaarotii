<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use PHPMailer\PHPMailer\PHPMailer; // Tambahkan ini
use PHPMailer\PHPMailer\Exception; // Tambahkan ini
use PHPMailer\PHPMailer\SMTP;     // Tambahkan ini

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
            $mail->addAddress($validatedData['email']); // Alamat email penerima

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Verifikasi Akun FAA';
            // Render view blade untuk konten email
            $mail->Body    = view('mail.otp', ['otp' => $otp])->render();
            $mail->AltBody = 'Kode OTP Anda adalah: ' . $otp . '. Kode ini akan kedaluwarsa dalam 10 menit.';

            $mail->send();
            \Log::info('Email OTP berhasil dikirim ke ' . $validatedData['email']);

        } catch (Exception $e) {
            // Jika email gagal, hapus data session dan kembalikan error
            session()->forget('registration_data');
            \Log::error('Gagal mengirim email OTP saat pendaftaran: ' . $e->getMessage() . ' PHPMailer Error: ' . $mail->ErrorInfo);

            // Tampilkan debug info PHPMailer langsung di browser
            echo "<h1>Error Pengiriman Email OTP!</h1>";
            echo "Pesan kesalahan: " . $e->getMessage();
            echo "<br>Detail Debug PHPMailer:<br>";
            echo "<pre>" . $mail->ErrorInfo . "</pre>"; // Debug info dari PHPMailer
            die(); // Hentikan eksekusi untuk menampilkan detail error
        }

        // Arahkan ke halaman verifikasi OTP
        return redirect()->route('otp.verify.show', ['email' => $validatedData['email']])
            ->with('status', 'Silakan cek email Anda untuk kode OTP verifikasi.');
    }
}
