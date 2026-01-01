<?php

namespace App\Livewire\Perte;

use App\Models\Perte;
use Livewire\Attributes\On;
use Livewire\Component;

class PerteTable extends Component
{
    public string $produit_nom = "";
    public string $varietee_nom = "";

    protected $listeners = [
        'refresh_component_perte' => '$refresh',
    ];


    #[On('search_detected_perte')]
    public function search_detected_perte($produit_nom, $varietee_nom)
    {
        $this->produit_nom = $produit_nom;
        $this->varietee_nom = $varietee_nom;
    }

    public function render()
    {
        $query = Perte::query()->join("varietees", 'varietees.id', 'pertes.varietee_id')
            ->join('produits', "produits.id", "varietees.produit_id")
            ->select("pertes.*", )
            ->with(["varietee", "varietee.produit"])
            ->orderBy("pertes.created_at", "desc");

        if (!empty($this->varietee_nom)) {
            $query = $query->whereRaw('UPPER(varietees.nom_varietee) LIKE ?', [
                '%' . trim(strtoupper($this->varietee_nom)) . '%'
            ]);
        }

        if (!empty($this->produit_nom)) {
            $query = $query->whereRaw('UPPER(produits.nom_produit) LIKE ?', [
                '%' . trim(strtoupper($this->produit_nom)) . '%'
            ]);
        }

        return view('livewire.perte.perte-table', ["pertes" => $query->paginate(10)]);
    }
}
