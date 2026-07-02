<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|string|in:Laki-laki,Perempuan',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($user->email !== $request->email) {
            $user->email_verified_at = now();
        }

        // Simpan data dasar & data e-commerce baru
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->city = $request->city;

        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile berhasil diperbarui');
    }
}

    // public function update(Request $request)
    // {
    //     /** @var \App\Models\User $user */
    //     $user = Auth::user();
        
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //         'current_password' => 'nullable|string',
    //         'new_password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     // Jika email diubah, pastikan email_verified_at tetap terisi waktu sekarang 
    //     // supaya user tidak tersangkut proteksi verifikasi akun di kemudian hari
    //     if ($user->email !== $request->email) {
    //         $user->email_verified_at = now();
    //     }

    //     $user->name = $request->name;
    //     $user->email = $request->email;

    //     if ($request->filled('current_password') && $request->filled('new_password')) {
    //         if (!Hash::check($request->current_password, $user->password)) {
    //             return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
    //         }
    //         $user->password = Hash::make($request->new_password);
    //     }

    //     $user->save(); // menyimpan semua perubahan ke dalam database 

    //     return redirect()->route('profile.edit')->with('success', 'Profile berhasil diperbarui');
    // }
