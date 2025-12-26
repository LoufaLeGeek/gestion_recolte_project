<?php

namespace App\Services;
use App\Models\PrixVarietee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChangerPrixService
{
    public function executer($varietee_id, $nouveau_montant)
    {
        // On cherche le ligne PrixVarietee et ajouter une date_fin
        return DB::transaction(function () use ($varietee_id, $nouveau_montant) {
            PrixVarietee::query()->where("varietee_id", $varietee_id)
                ->whereNull('date_fin')
                ->lockForUpdate() // evite les multiples update en meme temps
                ->update([
                    "date_fin" => Carbon::today(),
                ]);

            // On creer une nouvelle ligne PrixVarietee
            $nouveau_prix = PrixVarietee::create([
                "date_debut" => Carbon::today(),
                "date_fin" => null,
                "prix" => $nouveau_montant,
                "varietee_id" => $varietee_id,
            ]);

            return $nouveau_prix;
        });
    }
}
