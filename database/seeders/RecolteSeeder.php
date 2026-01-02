<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recolte;
use App\Models\Varietee;
use Carbon\Carbon;

class RecolteSeeder extends Seeder
{
    public function run()
    {
        // Date de début : il y a 3 mois
        $startDate = Carbon::now()->subMonths(3)->startOfWeek();
        $endDate   = Carbon::now();

        // Jours de récolte dans la semaine (3 récoltes)
        // Exemple : lundi, mercredi, vendredi
        $joursRecolte = [1, 3, 5];

        // Récupérer toutes les variétés
        $varietees = Varietee::all();

        foreach ($varietees as $varietee) {
            $date = $startDate->copy();

            while ($date->lte($endDate)) {
                foreach ($joursRecolte as $jour) {
                    $dateRecolte = $date->copy()->next($jour);

                    if ($dateRecolte->lte($endDate)) {
                        Recolte::create([
                            'date_recolte'     => $dateRecolte,
                            'quantite_recolte' => rand(500, 2000) / 10, // 50.0 à 200.0
                            'varietee_id'      => $varietee->id,
                        ]);
                    }
                }

                // passer à la semaine suivante
                $date->addWeek();
            }
        }
    }
}
