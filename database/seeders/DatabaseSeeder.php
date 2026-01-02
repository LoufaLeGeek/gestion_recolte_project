<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProduitsVarietesSeeder::class,
            PrixVarieteeSeeder::class,
            RecolteSeeder::class,
            VentesSeeder::class,
        ]);
    }
}
