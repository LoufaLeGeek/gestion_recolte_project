<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProduitsSeeder;
use Database\Seeders\VarieteesSeeder;
use Database\Seeders\RecoltesSeeder;
use Database\Seeders\PrixVarieteesSeeder;
use Database\Seeders\StocksSeeder;
use Database\Seeders\VentesSeeder;
use Database\Seeders\PerteSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Application data
        $this->call([
            ProduitsSeeder::class,
            VarieteesSeeder::class,
            RecoltesSeeder::class,
            PrixVarieteesSeeder::class,
            StocksSeeder::class,
            VentesSeeder::class,
            PerteSeeder::class,
        ]);
    }
}
