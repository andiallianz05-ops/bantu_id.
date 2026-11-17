<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Admin Bantu.id',
            'email' => 'admin@bantu.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Akun User Biasa
        User::create([
            'name' => 'Warga Kebutuhan',
            'email' => 'user@bantu.id',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}