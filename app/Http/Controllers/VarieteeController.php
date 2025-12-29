<?php

namespace App\Http\Controllers;

use App\Models\Varietee;
use App\Models\Produit;
use Illuminate\Http\Request;

class VarieteeController extends Controller
{
    /**
     * Afficher la liste des variétés avec recherche et filtres.
     */
    public function index(Request $request)
    {
        $query = Varietee::with('produit');

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
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $varietees = $query->paginate(10)->withQueryString();

        $produits = Produit::orderBy('nom_produit')->get();

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
        $request->validate([
            'nom_varietee' => 'required|string|max:255',
            'caracteristique_varietee' => 'required|string|min:10',
            'produit_id' => 'required|exists:produits,id',
        ]);

        $varietee->update($request->all());

        return redirect()->route('varietees.index')
            ->with('success', 'Variété mise à jour avec succès.');
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

    /**
     * Afficher les variétés d'un produit spécifique.
     */
    public function parProduit(Produit $produit)
    {
        $varietees = Varietee::where('produit_id', $produit->id)
            ->orderBy('nom_varietee')
            ->paginate(10);

        return view('varietees.par-produit', compact('varietees', 'produit'));
    }
}
