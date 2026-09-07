<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SIPEKA',
            'email' => 'admin@sipeka.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'aktif' => true,
        ]);

        User::create([
            'name' => 'Petugas Lapangan',
            'email' => 'petugas@sipeka.test',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'aktif' => true,
        ]);
    }
}