<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RecoltesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $coeurId = DB::table('varietees')->where('nom_varietee', 'Tomate Coeur de boeuf')->value('id');
        $ceriseId = DB::table('varietees')->where('nom_varietee', 'Tomate Cerise')->value('id');
        $bintjeId = DB::table('varietees')->where('nom_varietee', 'Bintje')->value('id');

        DB::table('recoltes')->insert([
            ['date_recolte' => Carbon::now()->subDays(10), 'quantite_recolte' => 150.500, 'varietee_id' => $coeurId, 'created_at' => $now, 'updated_at' => $now],
            ['date_recolte' => Carbon::now()->subDays(8), 'quantite_recolte' => 80.250, 'varietee_id' => $ceriseId, 'created_at' => $now, 'updated_at' => $now],
            ['date_recolte' => Carbon::now()->subDays(3), 'quantite_recolte' => 200.000, 'varietee_id' => $bintjeId, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
