<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@desaku.com',
            'password' => Hash::make('password123'), // ganti sesuai kebutuhan
            'role' => 'admin',
        ]);

        // User default
        User::create([
            'name' => 'Pengguna Biasa',
            'email' => 'user@desaku.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}
