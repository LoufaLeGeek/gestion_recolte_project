<?php

namespace App\Livewire\Perte;

use App\Models\Stock;
use App\Models\Varietee;
use App\Services\AjouterPerteService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PerteAdd extends Component
{

    public bool $toggle = false;

    #[Validate('bail|required|integer|exists:varietees,id')]
    public ?int $varietee_id = null;

    #[Validate('required|numeric|gt:0')]
    public ?float $quantite_perdu = null;

    #[Validate('required|string|min:3|max:255')]
    public string $motif = '';

    public function toggle_overlary()
    {
        $this->toggle = !$this->toggle;
    }

    public function save()
    {
        $this->validate();
        $service_perte = new AjouterPerteService();

        $quantite = Stock::where("varietee_id", $this->varietee_id)->value("quantite_actuelle");

        if ($quantite == null) {
            $this->addError('varietee_id', 'Stock non initialisé pour cette variété.');
            return;
        }

        if ($quantite < $this->quantite_perdu) {
            $this->addError('quantite_perdu', "La quantité demandée ({$this->quantite_perdu}) dépasse le stock disponible ({$quantite}).");
            return;
        }

        $perte = $service_perte->executer($this->varietee_id, $this->quantite_perdu, $this->motif);
        $this->toggle = false;
        $this->reset();
        $this->dispatch("refresh_component_perte", ["perte" => $perte]);
    }

    public function render()
    {
        return view('livewire.perte.perte-add', ["varietees" => Varietee::all()->pluck("nom_varietee", "id")]);
    }
}
