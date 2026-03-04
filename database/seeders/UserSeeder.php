<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@umroh.test'],
            [
                'name' => 'Zharfan',
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ]
        );

        // Staf Registrasi
        User::updateOrCreate(
            ['email' => 'staff@umroh.test'],
            [
                'name' => 'Saddam',
                'password' => Hash::make('password'),
                'role' => 'Staf Registrasi',
            ]
        );

        // User (Jamaah / Manajer)
        User::updateOrCreate(
            ['email' => 'user@umroh.test'],
            [
                'name' => 'Thoriq',
                'password' => Hash::make('password'),
                'role' => 'User',
            ]
        );
    }
}

