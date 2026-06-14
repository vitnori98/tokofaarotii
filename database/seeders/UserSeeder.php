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
        User::create([
            'name' => 'Admin Toko FAA',
            'email' => 'admin@faa.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_master',
        ]);
    }
}
