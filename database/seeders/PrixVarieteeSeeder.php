<?php

namespace Database\Seeders;

use App\Models\PrixVarietee;
use App\Models\Varietee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrixVarieteeSeeder extends Seeder
{
    public function run(): void
    {
        // Effacer les prix existants
        DB::table('prix_varietees')->truncate();

        $varietees = Varietee::all();
        $inserions = [];
        $dateDebut = now()->subDays(30); // Prix actif depuis 30 jours

        foreach ($varietees as $varietee) {
            $inserions[] = [
                'date_debut' => $dateDebut->format('Y-m-d'),
                'date_fin' => null, // Prix actuel
                'prix' => $this->genererPrixAleatoire(),
                'varietee_id' => $varietee->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert par lots de 50 pour performance
            if (count($inserions) >= 50) {
                DB::table('prix_varietees')->insert($inserions);
                $inserions = [];
            }
        }

        // Insert les derniers
        if (!empty($inserions)) {
            DB::table('prix_varietees')->insert($inserions);
        }

        $this->command->info('✅ Prix créés: ' . $varietees->count() . ' variétés avec prix actuels.');
    }

    private function genererPrixAleatoire(): float
    {
        // Génère un prix aléatoire entre 100 et 2000 FCFA
        return round(mt_rand(10000, 200000) / 100, 2); // 100.00 à 2000.00
    }
}
