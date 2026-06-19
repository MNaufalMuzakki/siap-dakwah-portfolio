<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // --- BIRO PUSAT (LDP) ---
            [
                'name' => 'Admin Biro Kesekretariatan',
                'email' => 'kestari.pusat@example.com',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'unit' => 'Biro Kesekretariatan',
                'color_code' => 'red',
            ],
            [
                'name' => 'Admin Biro Keuangan',
                'email' => 'keuangan.pusat@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'Biro Keuangan',
                'color_code' => 'red',
            ],
            [
                'name' => 'Admin Departemen Syiar Pusat',
                'email' => 'syiar.pusat@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'Departemen Syiar Pusat',
                'color_code' => 'red',
            ],
            [
                'name' => 'Admin Departemen Kaderisasi Pusat',
                'email' => 'kaderisasi.pusat@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'Departemen Kaderisasi Pusat',
                'color_code' => 'red',
            ],
            [
                'name' => 'Admin Departemen MedKomInfo',
                'email' => 'medkom.pusat@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'Departemen MedKomInfo',
                'color_code' => 'red',
            ],

            // --- LDF (FAKULTAS) ---
            [
                'name' => 'Admin LDF FIF',
                'email' => 'fif.fakultas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'LDF Al-Fath Fakultas Informatika',
                'color_code' => 'yellow',
            ],
            [
                'name' => 'Admin LDF FTE',
                'email' => 'fte.fakultas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'LDF Al-Fath Fakultas Teknik Elektro',
                'color_code' => 'blue_dark',
            ],
            [
                'name' => 'Admin LDF FIK',
                'email' => 'fik.fakultas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'LDF Al-Fath Fakultas Industri Kreatif',
                'color_code' => 'orange',
            ],
            [
                'name' => 'Admin LDF FIT',
                'email' => 'fit.fakultas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'LDF Al-Fath Fakultas Ilmu Terapan',
                'color_code' => 'green_light',
            ],
            [
                'name' => 'Admin LDF FKS',
                'email' => 'fks.fakultas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'LDF Al-Fath Fakultas Komunikasi dan Ilmu Sosial',
                'color_code' => 'purple',
            ],
            [
                'name' => 'Admin LDF FRI',
                'email' => 'fri.fakultas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'LDF Al-Fath Fakultas Rekayasa Industri',
                'color_code' => 'green_dark',
            ],
            [
                'name' => 'Admin LDF FEB',
                'email' => 'feb.fakultas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'unit' => 'LDF Al-Fath Fakultas Ekonomi dan Bisnis',
                'color_code' => 'blue_light',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(['email' => $userData['email']], $userData);
        }
    }
}
