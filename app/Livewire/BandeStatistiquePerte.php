<?php

namespace App\Livewire;

use App\Models\Perte;
use App\Models\Produit;
use Livewire\Attributes\On;
use Livewire\Component;

class BandeStatistiquePerte extends Component
{
    public $nombre_perte = 0;
    public $nombre_produit = 0;
    public $montant_totale = 0;
    public $quantite_totale = 0;

    #[On('refresh_component')]
    public function refresh_data()
    {
        $this->nombre_perte = Perte::query()->count();
        $this->nombre_produit = Produit::query()->whereHas("varietees.pertes")->count();
        $this->montant_totale = number_format(Perte::query()->sum("montant_estime"), 2, ",", "");
        $this->quantite_totale = number_format(Perte::query()->sum("quantite_perdu"), 3, ",", " ");
    }

    public function mount()
    {
        $this->refresh_data();
    }

    public function render()
    {
        return view('livewire.bande-statistique-perte');
    }
}
