<?php

namespace App\Http\Controllers;

use App\Models\Varietee;
use App\Models\Produit;
use Illuminate\Http\Request;

class VarieteeProduitController extends Controller
{
    /* PAGE PRINCIPALE */

    // Afficher la liste des produits et de leurs variétés

    public function index()
    {

         //Recupère tous les produits avec leurs variétés associées

        $produits = Produit::with('varietees')->get();

        // Retourne la vue avec les produits et leurs variétés
        return view('produit-varietee.index', compact('produits'));
    }

    /* CREATION PRODUIT OU VARIETE */

    // Enregistrer un nouveau produit ou une nouvelle variété

    public function store(Request $request)
    {
        //verification et validation des données pour le produit

        if ($request->type === 'produit') {
            $request->validate([
                'nom_produit' => 'required|string',
                'description_produit' => 'required|string',
            ]);

            // Création du produit

            Produit::create([
                'nom_produit' => $request->nom_produit,
                'description_produit' => $request->description_produit,
            ]);

            // Redirection avec message de succès
            return redirect()->back()->with('success', 'Produit créé avec succès.');
        }

        //verification et validation des données pour la variété

        if ($request->type === 'varietee') {
            $request->validate([
                'nom_varietee' => 'required|string',
                'produit_id' => 'required|exists:produits,id',
            ]);

            // Création de la variété

            Varietee::create([
                'nom_varietee' => $request->nom_varietee,
                'caracteristique_varietee' => $request->caracteristique_varietee,
                'produit_id' => $request->produit_id,
            ]);

            // Redirection avec message de succès

            return redirect()->back()->with('success', 'Variété créée avec succès.');
        }
    }

    /* EDITION PRODUIT OU VARIETE */

    // Afficher le formulaire d'édition pour un produit ou une variété

    public function edit(Request $request, $id)
    {

        // Vérifier le type et récupération du produit à modifier

        if ($request->type === 'produit') {
            $produit = Produit::findOrFail($id);

            // Retourner la vue d'édition avec les données du produit
            return view('produit-varietee.index', compact('produit'));
        }

        //verifier l type et recuperation de la variété a modifier

        if ($request->type === 'varietee') {
            $varietee = Varietee::findOrFail($id);

            // pour choisir le produit associé

            $produits = Produit::all();

            // Retourner la vue d'édition avec les données de la variété et la liste des produits

            return view('produit-varietee.index', compact('varietee', 'produits'));
        }
    }

    /* MODIFICATION PRODUIT OU VARIETE */

    // Mettre à jour un produit ou une variété existante

    public function update(Request $request, $id)
    {

        // Vérifier le type et validation des données pour le produit

        if ($request->type === 'produit') {
            $request->validate([
                'nom_produit' => 'required|string',
                'description_produit' => 'required|string',
            ]);

            // Récupération et mise à jour du produit

            $produit = Produit::findOrFail($id);
            $produit->update([
                'nom_produit' => $request->nom_produit,
                'description_produit' => $request->description_produit,
            ]);

            // Redirection avec message de succès

            return redirect()->route('produit-varietee.index')->with('success', 'Produit modifié avec succès.');
        }

        // Vérifier le type et validation des données pour la variété

        if ($request->type === 'varietee') {
            $request->validate([
                'nom_varietee' => 'required|string',
                'produit_id' => 'required|exists:produits,id',
            ]);

            // Récupération et mise à jour de la variété

            $varietee = Varietee::findOrFail($id);
            $varietee->update([
                'nom_varietee' => $request->nom_varietee,
                'caracteristique_varietee' => $request->caracteristique_varietee,
                'produit_id' => $request->produit_id,
            ]);

            // Redirection avec message de succès

            return redirect()->route('produit-varietee.index')->with('success', 'Variété modifiée avec succès.');
        }
    }

    /* SUPPRESSION PRODUIT OU VARIETE */

    // Supprimer un produit ou une variété

    public function destroy(Request $request, $id)
    {

        // Vérification si c'est un produit à supprimer
        if ($request->type === 'produit') {

            // Récupération et suppression du produit
            $produit = Produit::findOrFail($id);
            $produit->delete();

            // Redirection avec message de succès

            return redirect()->back()->with('success', 'Produit supprimé avec succès.');
        }

        // Vérification si c'est une variété à supprimer

        if ($request->type === 'varietee') {

            // Récupération et suppression de la variété
            $varietee = Varietee::findOrFail($id);
            $varietee->delete();

            // Redirection avec message de succès

            return redirect()->back()->with('success', 'Variété supprimée avec succès.');
        }
    }
}
