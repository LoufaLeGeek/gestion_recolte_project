<?php

namespace App\Livewire\Stock;

use App\Models\Produit;
use App\Models\Stock;
use App\Models\Varietee;
use Livewire\Component;

class BandeStatistiqueStock extends Component
{
    public $nombre_varietee_stock = 0;
    public $quantite_stocks = 0;
    public $repture_stocks = 0;
    public $produit_stocks = 0;

    public function update_data()
    {
        $this->nombre_varietee_stock = Stock::query()->count();
        $this->quantite_stocks = number_format((float)Stock::query()->sum("quantite_actuelle"), 3, ",", " ");
        $this->repture_stocks = Stock::query()->where("quantite_actuelle", 0)->count() + Varietee::query()->whereDoesntHave("stock")->count();
    }

    public function mount()
    {
        $this->update_data();
    }

    public function render()
    {
        return view('livewire.stock.bande-statistique-stock');
    }
}
