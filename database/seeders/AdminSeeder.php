<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        User::create([
            'name' => 'Administrador',
            'email' => 'a@example.com',
            'password' => Hash::make('admin123'), // Contraseña
            'role' => 'admin', // Rol de administrador
            'controlNumber' => '00000000', // Número de control ficticio

        ]);

        echo "Administrador creado con éxito: admin@example.com / Contraseña: admin123\n";
 
    }
}
