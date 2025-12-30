<?php

namespace App\Http\Controllers;

use App\Models\Varietee;

use App\Models\Produit;

use Illuminate\Http\Request;

class VarieteeProduitController extends Controller
{
    /* =====================================================
       PAGE PRINCIPALE : LISTE PRODUITS ET VARIÉTÉS
       ===================================================== */
    public function index(Request $request)
    {
        // Initialisation de la requête avec la relation varietees
        $query = Produit::with('varietees');

        // Vérification si un mot-clé de recherche est fourni
        if ($request->filled('search')) {

            // Récupération du mot-clé de recherche en minuscule
            $search = strtolower($request->search);

            // Filtrage par nom de produit ou nom de variété
            $query->whereRaw(
                "LOWER(nom_produit) LIKE '%' || ? || '%'",
                [$search]
            )
            ->orWhereHas('varietees', function ($q) use ($search) {

                // Condition de recherche sur le nom de la variété
                $q->whereRaw(
                    "LOWER(nom_varietee) LIKE '%' || ? || '%'",
                    [$search]
                );
            });
        }

        // Récupération des produits avec pagination (5 par page)
        $produits = $query->paginate(5);

        // Calcul du nombre total de produits et de variétés
        $total_produits = Produit::count();

        $total_varietes = Varietee::count();

        // Retour de la vue avec les données nécessaires
        return view('produit-varietee.index',compact('produits', 'total_produits', 'total_varietes'));

    }

    /* =====================================================
    CRÉATION D'UN PRODUIT OU D'UNE VARIÉTÉ
       ===================================================== */
    public function store(Request $request)
    {
        // Vérification si la création concerne un produit
        if ($request->type === 'produit') {

            // Validation des données du produit
            $request->validate([
                'nom_produit' => 'required|string',
                'description_produit' => 'required|string',
            ]);

            // Création du produit en base de données
            Produit::create(
                $request->only('nom_produit', 'description_produit')
            );

            // Redirection avec message de succès
            return redirect()->back()->with('success', 'Produit créé avec succès.');
        }

    }

    /* =====================================================
    MODIFICATION D'UN PRODUIT OU D'UNE VARIÉTÉ
       ===================================================== */
    public function update(Request $request, $id)
    {
        // Vérification si la modification concerne un produit
        if ($request->type === 'produit') {

            // Validation des données du produit
            $request->validate([
                'nom_produit' => 'required|string',
                'description_produit' => 'required|string',
            ]);

            // Récupération du produit à modifier
            $produit = Produit::findOrFail($id);

            // Mise à jour du produit
            $produit->update(
                $request->only('nom_produit', 'description_produit')
            );

            // Redirection avec message de succès
            return redirect()
                ->route('produit-varietee.index')
                ->with('success', 'Produit modifié avec succès.');
        }

    }

    /* =====================================================
       SUPPRESSION D'UN PRODUIT OU D'UNE VARIÉTÉ
       ===================================================== */
    public function destroy(Request $request, $id)
    {
        // Vérification si la suppression concerne un produit
        if ($request->type === 'produit') {

            // Récupération du produit à supprimer
            $produit = Produit::findOrFail($id);

            // Suppression du produit
            $produit->delete();

            // Redirection avec message de succès
            return redirect()
                ->back()
                ->with('success', 'Produit supprimé avec succès.');
        }

    }
}
