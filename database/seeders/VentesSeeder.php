<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VentesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $ceriseId = DB::table('varietees')->where('nom_varietee', 'Tomate Cerise')->value('id');
        $bintjeId = DB::table('varietees')->where('nom_varietee', 'Bintje')->value('id');

        $prixCerise = DB::table('prix_varietees')->where('varietee_id', $ceriseId)->orderByDesc('date_debut')->value('prix') ?? 2.00;
        $prixBintje = DB::table('prix_varietees')->where('varietee_id', $bintjeId)->orderByDesc('date_debut')->value('prix') ?? 0.80;

        DB::table('ventes')->insert([
            ['date_vente' => Carbon::now()->subDays(5), 'quantite_vendu' => 20.500, 'prix_unitaire' => $prixCerise, 'montant_totale' => round(20.5 * $prixCerise, 2), 'varietee_id' => $ceriseId, 'created_at' => $now, 'updated_at' => $now],
            ['date_vente' => Carbon::now()->subDays(2), 'quantite_vendu' => 50.000, 'prix_unitaire' => $prixBintje, 'montant_totale' => round(50.0 * $prixBintje, 2), 'varietee_id' => $bintjeId, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
