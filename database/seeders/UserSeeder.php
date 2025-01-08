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
            'name' => 'Usuario prueba',
            'email' => 'user1@example.com',
            'password' => Hash::make('password123'),
            'controlNumber' => '111111111',
            'username' => 'testuser',
            'role' => 'psychologist',
        ]);
    }
}
