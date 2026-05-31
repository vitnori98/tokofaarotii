<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * * Usage in routes:
     * Route::middleware(['auth', 'role:admin_master,pemilik'])->group(function () { ... })
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();
        
        // 2. Cek apakah role user ada di dalam daftar role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 3. Jika tidak sesuai, hentikan dan beri error 403 (Forbidden)
        // Ini mencegah loop karena tidak dilempar kembali ke halaman yang sama
        abort(403, 'Anda tidak memiliki hak akses ke halaman ini!');
    }
}