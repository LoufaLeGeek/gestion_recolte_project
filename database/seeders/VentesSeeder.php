<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🛒 Création des ventes basées sur les prix...');

        DB::table('ventes')->truncate();

        // Récupérer toutes les variétés avec leurs prix actuels en une requête
        $varieteesAvecPrix = DB::table('varietees as v')
            ->join('prix_varietees as pv', function($join) {
                $join->on('v.id', '=', 'pv.varietee_id')
                     ->whereNull('pv.date_fin');
            })
            ->select('v.id', 'v.nom_varietee', 'pv.prix', 'pv.date_debut')
            ->get();

        $this->command->info("💰 Trouvé {$varieteesAvecPrix->count()} variétés avec prix actuel");

        $ventesBatch = [];
        $ventesTotales = 0;
        $now = Carbon::now();

        foreach ($varieteesAvecPrix as $varietee) {
            $nbVentes = rand(20, 30);
            $dateDebutPrix = Carbon::parse($varietee->date_debut);

            for ($i = 0; $i < $nbVentes; $i++) {
                // Date aléatoire dans la période de validité du prix
                $joursDiff = $dateDebutPrix->diffInDays($now);
                $joursAleatoire = rand(0, min($joursDiff, 180));

                $dateVente = $dateDebutPrix->copy()
                    ->addDays($joursAleatoire)
                    ->addHours(rand(8, 18))
                    ->addMinutes(rand(0, 59));

                // Quantité réaliste
                $quantite = $this->genererQuantiteRealiste();

                // Prix avec variation intelligente
                $prixVente = $this->appliquerVariations($varietee->prix, $dateVente);

                $ventesBatch[] = [
                    'date_vente' => $dateVente,
                    'quantite_vendu' => $quantite,
                    'prix_unitaire' => $prixVente,
                    'montant_totale' => round($quantite * $prixVente, 2),
                    'varietee_id' => $varietee->id,
                    'created_at' => $dateVente,
                    'updated_at' => $dateVente,
                ];

                $ventesTotales++;

                // Batch insert
                if (count($ventesBatch) >= 1000) {
                    DB::table('ventes')->insert($ventesBatch);
                    $ventesBatch = [];
                }
            }
        }

        // Dernier batch
        if (!empty($ventesBatch)) {
            DB::table('ventes')->insert($ventesBatch);
        }

        $this->command->info("🎉 {$ventesTotales} ventes créées avec succès!");
        $this->afficherStatsFinales();
    }

    private function genererQuantiteRealiste(): float
    {
        // Distribution réaliste des quantités
        $distribution = rand(1, 100);

        if ($distribution <= 10) { // 10%: très petites quantités
            return round(rand(1, 10) / 10, 3); // 0.1-1.0 kg
        } elseif ($distribution <= 40) { // 30%: petites quantités
            return round(rand(10, 50) / 10, 3); // 1.0-5.0 kg
        } elseif ($distribution <= 80) { // 40%: quantités moyennes
            return round(rand(50, 150) / 10, 3); // 5.0-15.0 kg
        } else { // 20%: grandes quantités
            return round(rand(150, 300) / 10, 3); // 15.0-30.0 kg
        }
    }

    private function appliquerVariations(float $prixBase, Carbon $date): float
    {
        // Variation journalière (±10%)
        $variationJour = rand(-10, 10) / 100;

        // Variation saisonnière
        $mois = $date->month;
        $saisonMulti = match(true) {
            $mois >= 12 || $mois <= 2 => 1.15, // Hiver +15%
            $mois >= 3 && $mois <= 5 => 1.00,  // Printemps normal
            $mois >= 6 && $mois <= 8 => 0.85,  // Été -15%
            default => 1.05,                   // Automne +5%
        };

        return round($prixBase * (1 + $variationJour) * $saisonMulti, 2);
    }

    private function afficherStatsFinales(): void
    {
        $stats = DB::select('
            SELECT
                COUNT(*) as ventes,
                SUM(quantite_vendu) as quantite,
                AVG(prix_unitaire) as prix_moyen,
                SUM(montant_totale) as ca_total
            FROM ventes
        ')[0];

        $this->command->info("\n📊 RÉSUMÉ FINAL:");
        $this->command->info("  • Ventes: " . number_format($stats->ventes, 0, ',', ' '));
        $this->command->info("  • Quantité: " . number_format($stats->quantite, 2, ',', ' ') . " kg");
        $this->command->info("  • Prix moyen: " . number_format($stats->prix_moyen, 2, ',', ' ') . " FCFA/kg");
        $this->command->info("  • CA total: " . number_format($stats->ca_total, 2, ',', ' ') . " FCFA");
    }
}
