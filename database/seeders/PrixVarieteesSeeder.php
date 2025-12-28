<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PrixVarieteesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $coeurId = DB::table('varietees')->where('nom_varietee', 'Tomate Coeur de boeuf')->value('id');
        $ceriseId = DB::table('varietees')->where('nom_varietee', 'Tomate Cerise')->value('id');

        DB::table('prix_varietees')->insert([
            ['date_debut' => Carbon::now()->subMonths(2)->toDateString(), 'date_fin' => Carbon::now()->subMonth()->toDateString(), 'prix' => 1.20, 'varietee_id' => $coeurId, 'created_at' => $now, 'updated_at' => $now],
            ['date_debut' => Carbon::now()->subMonth()->toDateString(), 'date_fin' => null, 'prix' => 1.50, 'varietee_id' => $coeurId, 'created_at' => $now, 'updated_at' => $now],
            ['date_debut' => Carbon::now()->subMonth()->toDateString(), 'date_fin' => null, 'prix' => 2.00, 'varietee_id' => $ceriseId, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
