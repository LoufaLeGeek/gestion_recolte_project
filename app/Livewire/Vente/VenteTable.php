<?php

namespace App\Livewire\Vente;

use App\Models\Vente;
use Livewire\Component;

class VenteTable extends Component
{

    protected $listeners = [
        'refresh_component' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.vente.vente-table', ["ventes" => Vente::with("varietee.produit")->orderBy("id", "asc")->paginate(10)]);
    }
}
