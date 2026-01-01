<?php

namespace App\Services;
use App\Models\Perte;
use App\Models\Varietee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AjouterPerteService
{
    public function executer($varietee_id, $quantite_perdue, $motif)
    {
        return DB::transaction(function () use ($varietee_id, $quantite_perdue, $motif) {

            // chercher la variete et son prix actuelle via la relation prix_actuelle
            $varietee = Varietee::with("prix_actuelle")->findOrFail($varietee_id);

            // calculer determiner le montant estimer de la perte (totale)

            $prix_totale = $varietee->prix_actuelle != null ? $varietee->prix_actuelle->prix * $quantite_perdue : 0;

            // creation de la perte
            return Perte::create(
                [
                    "date_perte" => Carbon::now(),
                    "quantite_perdu" => $quantite_perdue,
                    "montant_estime" => $prix_totale,
                    "motif" => $motif,
                    "varietee_id" => $varietee_id
                ]
            );
        });
    }
}
