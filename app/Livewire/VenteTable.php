<?php

namespace App\Livewire;

use App\Models\Vente;
use Livewire\Component;

class VenteTable extends Component
{

    protected $listeners = [
        'refresh_component' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.vente-table', ["ventes" => Vente::with("varietee.produit")->orderBy("created_at", "DESC")->paginate(10)]);
    }
}
