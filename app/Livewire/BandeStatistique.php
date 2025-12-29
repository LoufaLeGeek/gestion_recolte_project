<?php

namespace App\Livewire;

use App\Models\Produit;
use App\Models\Vente;
use Livewire\Component;

class BandeStatistique extends Component
{

    public $montant_totale_vente = 0;
    public $nombre_totale_vente = 0;
    public $nombre_totale_produit = 0;
    public $quantite_totale_vendue = 0;

    protected $listeners = [
        'refresh_component' => 'refreshState',
    ];

    public function refreshState()
    {
        $this->nombre_totale_vente = Vente::query()->count();
        $this->montant_totale_vente = number_format(Vente::query()->sum("montant_totale"), 2, ",", " ");
        $this->quantite_totale_vendue = number_format(Vente::query()->sum("quantite_vendu"), 3, ",", " ");
        $this->nombre_totale_produit = Produit::query()->whereHas("varietees.ventes")->count();
    }

    public function mount()
    {
        $this->refreshState();
    }

    public function render()
    {
        return view('livewire.bande-statistique');
    }
}
