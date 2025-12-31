<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;

class SearchBarStock extends Component
{

    public $produit_nom = "";
    public $varietee_nom = "";

    #[Locked()]
    public $disponible = false;

    #[Locked()]
    public $epuise = false;

    #[Locked()]
    protected array $allowedFields = ['disponible', 'epuise'];

    public function search()
    {
        $this->dispatch(
            "search_detected",
            produit_nom: $this->produit_nom,
            varietee_nom: $this->varietee_nom
        );
    }

    #[Locked()]
    public function toggle(string $field)
    {
        if (!\in_array($field, $this->allowedFields)) {
            return;
        }

        if ($field === 'disponible') {
            $this->disponible = !$this->disponible;
            if ($this->disponible)
                $this->epuise = false;
        }

        if ($field === 'epuise') {
            $this->epuise = !$this->epuise;
            if ($this->epuise)
                $this->disponible = false;
        }
        $this->checked();
    }

    public function checked()
    {
        $this->dispatch(
            "checked_detected",
            disponible: $this->disponible,
            epuise: $this->epuise
        );
    }

    public function render()
    {
        return view('livewire.search-bar-stock');
    }
}
