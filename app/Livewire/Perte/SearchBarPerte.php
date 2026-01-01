<?php

namespace App\Livewire\Perte;

use Livewire\Component;

class SearchBarPerte extends Component
{
    public string $produit_nom = "";
    public string $varietee_nom = "";


    public function search()
    {
        $this->dispatch(
            "search_detected_perte",
            produit_nom: $this->produit_nom,
            varietee_nom: $this->varietee_nom
        );
    }


    public function render()
    {
        return view('livewire.perte.search-bar-perte');
    }
}
