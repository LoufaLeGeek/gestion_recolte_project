<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProduitsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('produits')->insert([
            ['nom_produit' => 'Tomate', 'description_produit' => 'Tomates rouges, cultivées localement.', 'created_at' => $now, 'updated_at' => $now],
            ['nom_produit' => 'Pomme de terre', 'description_produit' => 'Tubercule polyvalent.', 'created_at' => $now, 'updated_at' => $now],
            ['nom_produit' => 'Carotte', 'description_produit' => 'Carottes sucrées et croquantes.', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
