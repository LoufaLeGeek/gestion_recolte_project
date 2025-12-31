<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use App\Models\Varietee;
use Livewire\Component;
use Livewire\WithPagination;
class StockTable extends Component
{
    use WithPagination;
    public string $produit_nom = "";
    public string $varietee_nom = "";
    public bool $disponible = false;
    public bool $epuise = false;

    #[On('search_detected')]
    public function search_detected($produit_nom, $varietee_nom)
    {
        $this->produit_nom = $produit_nom;
        $this->varietee_nom = $varietee_nom;
    }

    #[On("checked_detected")]
    public function checked_detected($disponible, $epuise)
    {
        $this->disponible = $disponible;
        $this->epuise = $epuise;
    }

    public function render()
    {
        $query = Varietee::query()
            ->join('produits', 'varietees.produit_id', '=', 'produits.id')
            ->leftJoin('stocks', 'varietees.id', '=', 'stocks.varietee_id')
            ->select('varietees.*')
            ->with(['produit', 'stock'])
            ->orderBy('varietees.created_at', 'desc');

        if (!empty($this->varietee_nom)) {
            $query = $query->whereRaw('UPPER(varietees.nom_varietee) LIKE ?', [
                '%' . strtoupper($this->varietee_nom) . '%'
            ]);
        }

        if (!empty($this->produit_nom)) {
            $query = $query->whereRaw('UPPER(produits.nom_produit) LIKE ?', [
                '%' . strtoupper($this->produit_nom) . '%'
            ]);
        }

        if($this->disponible){
            $query = $query->where("stocks.quantite_actuelle", '>', 0);
        }

        if($this->epuise){
            $query = $query->where("stocks.quantite_actuelle",  0)->orWhereDoesntHave("stock");
        }

        $this->resetPage();
        return view('livewire.stock-table', ["varietees" => $query->paginate(10)]);
    }
}
