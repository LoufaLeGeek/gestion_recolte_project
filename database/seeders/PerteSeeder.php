<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PerteSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $coeurId = DB::table('varietees')->where('nom_varietee', 'Tomate Coeur de boeuf')->value('id');

        DB::table('pertes')->insert([
            ['date_perte' => Carbon::now()->subDays(7), 'quantite_perdu' => 5.250, 'montant_estime' => 5.25 * 1.50, 'motif' => 'Pourriture', 'varietee_id' => $coeurId, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
