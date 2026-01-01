<?php

namespace App\Livewire;

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
        return view('livewire.search-bar-perte');
    }
}
