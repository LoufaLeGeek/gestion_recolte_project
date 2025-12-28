<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VarieteesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $tomateId = DB::table('produits')->where('nom_produit', 'Tomate')->value('id');
        $pdtId = DB::table('produits')->where('nom_produit', 'Pomme de terre')->value('id');
        $carotteId = DB::table('produits')->where('nom_produit', 'Carotte')->value('id');

        DB::table('varietees')->insert([
            ['nom_varietee' => 'Tomate Coeur de boeuf', 'caracteristique_varietee' => 'Grosse, chair dense.', 'produit_id' => $tomateId, 'created_at' => $now, 'updated_at' => $now],
            ['nom_varietee' => 'Tomate Cerise', 'caracteristique_varietee' => 'Petite et sucrée.', 'produit_id' => $tomateId, 'created_at' => $now, 'updated_at' => $now],
            ['nom_varietee' => 'Bintje', 'caracteristique_varietee' => 'Bonne pour purée.', 'produit_id' => $pdtId, 'created_at' => $now, 'updated_at' => $now],
            ['nom_varietee' => 'Nantaise', 'caracteristique_varietee' => 'Doux et long.', 'produit_id' => $carotteId, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
