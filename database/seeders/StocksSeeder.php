<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StocksSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $coeurId = DB::table('varietees')->where('nom_varietee', 'Tomate Coeur de boeuf')->value('id');
        $ceriseId = DB::table('varietees')->where('nom_varietee', 'Tomate Cerise')->value('id');
        $bintjeId = DB::table('varietees')->where('nom_varee', 'Bintje')->value('id');

        // If a typo prevented finding Bintje, try alternate column name
        if (!$bintjeId) {
            $bintjeId = DB::table('varietees')->where('nom_varietee', 'Bintje')->value('id');
        }

        DB::table('stocks')->insert([
            ['quantite_actuelle' => 120.750, 'varietee_id' => $coeurId, 'created_at' => $now, 'updated_at' => $now],
            ['quantite_actuelle' => 60.250, 'varietee_id' => $ceriseId, 'created_at' => $now, 'updated_at' => $now],
            ['quantite_actuelle' => 200.000, 'varietee_id' => $bintjeId, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
