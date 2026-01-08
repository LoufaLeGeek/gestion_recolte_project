<?php

namespace App\Http\Controllers;

use App\Models\Varietee;
use App\Models\Produit;
use App\Services\ChangerPrixService;
use Illuminate\Http\Request;

class VarieteeController extends Controller
{
    /**
     * Afficher la liste des variétés avec recherche et filtres.
     */
    public function index(Request $request)
    {
        $query = Varietee::with(['produit', 'prix_actuelle']);

        // Filtre par produit
        if ($request->filled('produit_id')) {
            $query->where('produit_id', $request->produit_id);
        }

        // Recherche par nom ou caractéristiques
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom_varietee', 'LIKE', "%{$search}%")
                ->orWhere('caracteristique_varietee', 'LIKE', "%{$search}%")
                ->orWhereHas('produit', function($q) use ($search) {
                    $q->where('nom_produit', 'LIKE', "%{$search}%");
                });
            });
        }

        // Trier par défaut par date de création descendante
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $varietees = $query->paginate(10)->withQueryString();

        $produits = Produit::All();

        return view('varietees.index', compact('varietees', 'produits'));
    }


    /**
     * Afficher le formulaire de création d'une variété.
     */
    public function create(Request $request)
    {
        $produits = Produit::orderBy('nom_produit')->get();

        // Pré-sélectionner un produit si spécifié dans l'URL
        $selectedProduitId = $request->get('produit_id');

        return view('varietees.create', compact('produits', 'selectedProduitId'));
    }


    /**
     * Enregistrer une nouvelle variété.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_varietee' => 'required|string|max:255',
            'caracteristique_varietee' => 'required|string|min:10',
            'produit_id' => 'required|exists:produits,id',
        ]);

        Varietee::create($request->all());

        return redirect()->route('varietees.index')
            ->with('success', 'Variété créée avec succès.');
    }

    /**
     * Afficher une variété spécifique.
     */
    public function show(Varietee $varietee)
    {
        $varietee->load('produit');
        return view('varietees.show', compact('varietee'));
    }

    /**
     * Afficher le formulaire d'édition d'une variété.
     */
    public function edit(Varietee $varietee)
    {
        $produits = Produit::orderBy('nom_produit')->get();
        return view('varietees.edit', compact('varietee', 'produits'));
    }

    /**
     * Mettre à jour une variété.
     */
public function update(Request $request, Varietee $varietee)
{


    $change_price = new ChangerPrixService();


    $validated = $request->validate([
        'nom_varietee' => 'required|string|max:255',
        'caracteristique_varietee' => 'required|string',
        'produit_id' => 'required|exists:produits,id',
        'nouveau_prix' => 'nullable|numeric|min:0',
        'date_effet' => 'nullable|date',
    ]);

    // Mise à jour de la variété
    $varietee->update([
        'nom_varietee' => $validated['nom_varietee'],
        'caracteristique_varietee' => $validated['caracteristique_varietee'],
        'produit_id' => $validated['produit_id'],
    ]);


        $nouveauPrix = $request->input('nouveau_prix');


    // Gestion du prix si fourni
    // if ($request->has('changer_prix') && $request->filled('nouveau_prix')) {
    //     $nouveauPrix = $request->input('nouveau_prix');
    //     $dateEffet = $request->input('date_effet', now()->toDateString());

    //     // 1. Mettre à jour la date_fin de l'ancien prix s'il existe
    //     if ($varietee->prix_actuelle) {
    //         $varietee->prix_actuelle->update([
    //             'date_fin' => $dateEffet
    //         ]);
    //     }

    //     // 2. Créer le nouveau prix
    //     $varietee->prix_varietees()->create([
    //         'prix' => $nouveauPrix,
    //         'date_debut' => $dateEffet,
    //         'date_fin' => null // Prix actuel
    //     ]);

    //     // Message de succès spécifique
    //     return redirect()->route('varietees.index', $varietee)
    //         ->with('success', 'Variété et prix mis à jour avec succès!');
    // }


    $change_price->executer($varietee->id, $nouveauPrix);

    return redirect()->route('varietees.index', $varietee)
        ->with('success', 'Variété mise à jour avec succès!');
}

    /**
     * Supprimer une variété.
     */
    public function destroy(Varietee $varietee)
    {
        $varietee->delete();

        return redirect()->route('varietees.index')
            ->with('success', 'Variété supprimée avec succès.');
    }

}
