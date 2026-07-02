<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data bawaan kamu (TIDAK DIUBAH)
        User::create([
            'name' => 'Admin Toko FAA',
            'email' => 'admin@faa.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_master',
        ]);

        // TAMBAHAN: Akun Pemilik Toko
        User::create([
            'name' => 'Pemilik Toko FAA',
            'email' => 'pemilik@faa.com',
            'password' => Hash::make('pemilik123'), // Silakan ganti password-nya di sini
            'role' => 'pemilik', // Menyesuaikan dengan role pemilik toko Anda
        ]);
    }
}
