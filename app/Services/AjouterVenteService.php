<?php

namespace App\Services;
use App\Models\Varietee;
use App\Models\Vente;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AjouterVenteService
{
    public function executer($varietee_id, $quantite_vendue)
    {
        return DB::transaction(function () use ($varietee_id, $quantite_vendue) {

            // chercher la variete et son prix actuelle via la relation prix_actuelle
            $varietee = Varietee::with("prix_actuelle")->findOrFail($varietee_id);

            // calculer determiner le prix_unitaire et le prix_totale
            $prix_unitaire = $varietee->prix_actuelle->prix;
            $prix_totale = $prix_unitaire * $quantite_vendue;

            // creation de la vente
            return Vente::create(
                [
                    "date_vente" => Carbon::now(),
                    "quantite_vendu" => $quantite_vendue,
                    "prix_unitaire" => $prix_unitaire,
                    "montant_totale" => $prix_totale,
                    "varietee_id" => $varietee_id
                ]
            );
        });
    }
}
