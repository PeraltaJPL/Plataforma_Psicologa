<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama al UserSeeder
        $this->call(UserSeeder::class);
        $this->call([
            AdminSeeder::class, // Seeder del administrador
        ]);

    }
}
