<?php

namespace App\Livewire\Vente;

use App\Models\Stock;
use App\Models\Varietee;
use App\Services\AjouterVenteService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class VenteAdd extends Component
{

    public $toggle = false;

    #[Validate('bail|required|integer|exists:varietees,id|exists:stocks,varietee_id')]
    public ?int $varietee_id = null;

    #[Validate('required|numeric|gt:0')]
    public ?float $quantite_vendue = null;

    public function toggle_overlay()
    {
        $this->toggle = !$this->toggle;
    }

    public function save()
    {
        $this->validate();

        $quantite = Stock::where("varietee_id", $this->varietee_id)->value("quantite_actuelle");
        $varietee = Varietee::with("prix_actuelle")->find($this->varietee_id);
        $service_vente = new AjouterVenteService();

        if ($quantite == null) {
            $this->addError('varietee_id', 'Stock non initialisé pour cette variété.');
            return;
        }

        if ($quantite < $this->quantite_vendue) {
            $this->addError('quantite_vendue', "La quantité demandée ({$this->quantite_vendue}) dépasse le stock disponible ({$quantite}).");
            return;
        }

        if ($varietee->prix_actuelle?->prix === null) {
            $this->addError('varietee_id', "Cette variété n’a pas de prix défini.");
            return;
        }

        if ($quantite < $this->quantite_vendue) {
            $this->addError('quantite_vendue', "La quantité demandée ({$this->quantite_vendue}) dépasse le stock disponible ({$quantite}).");
            return;
        }

        $vente = $service_vente->executer($this->varietee_id, $this->quantite_vendue);
        $this->toggle = false;
        $this->reset();
        $this->dispatch("refresh_component", ["vente" => $vente]);
    }

    public function render()
    {
        return view('livewire.vente.vente-add', ["varietees" => Varietee::all()->pluck("nom_varietee", "id")]);
    }
}
