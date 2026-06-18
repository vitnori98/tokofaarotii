<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();

        // Cek apakah user sudah verifikasi (kecuali admin/pemilik)
        if (!in_array($user->role, ['admin_master', 'pemilik']) && is_null($user->email_verified_at)) {
            // Generate OTP baru jika belum ada atau sudah kadaluwarsa
            if (is_null($user->otp) || \Carbon\Carbon::now()->gt($user->otp_expires_at)) {
                $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $user->otp = $otp;
                $user->otp_expires_at = \Carbon\Carbon::now()->addMinutes(10);
                $user->save();
                
                try {
                    \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
                } catch (\Exception $e) {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['email' => 'Gagal mengirim ulang OTP. ' . $e->getMessage()]);
                }
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('otp.verify.show', ['email' => $user->email])
                ->with('status', 'Email Anda belum terverifikasi. Silakan masukkan kode OTP yang dikirim ke email Anda.');
        }

        $request->session()->regenerate();

        // Cek Role untuk Redirection
        if (in_array($user->role, ['admin_master', 'pemilik'])) {
            return redirect()->intended(route('dashboard'));
        }

        // Untuk User Biasa / Pelanggan
        return redirect()->intended(route('welcome'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}