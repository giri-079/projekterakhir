<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat admin jika belum ada
        User::updateOrCreate(
            ['username' => 'admin123'],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Hash password dengan benar
                'level' => 'admin',
            ]
        );
    }
}

