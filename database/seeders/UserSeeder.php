<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {


        // Akun Admin Sultan
        User::create([
            'name' => 'Alia Admin',
            'email' => 'admin@alia.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Akun Member Biasa
        User::create([
            'name' => 'Sultan Gamers',
            'email' => 'member@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
