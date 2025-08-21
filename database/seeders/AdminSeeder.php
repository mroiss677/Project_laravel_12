<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // pastikan tidak duplikat
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('password123'), // ganti sesuai kebutuhan
                'role' => 'admin',
            ]
        );
    }
}
