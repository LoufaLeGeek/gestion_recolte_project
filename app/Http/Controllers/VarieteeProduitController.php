<?php

namespace App\Http\Controllers;

use App\Models\Varietee;
use App\Models\Produit;
use Illuminate\Http\Request;

class VarieteeProduitController extends Controller
{
    /* PAGE PRINCIPALE */
    public function index()
    {
        $produits = Produit::with('varietees')->get();
        return view('produit-varietee.index', compact('produits'));
    }

    /* CREATION PRODUIT OU VARIETE */
    public function store(Request $request)
    {
        if ($request->type === 'produit') {
            $request->validate([
                'nom_produit' => 'required|string',
                'description_produit' => 'required|string',
            ]);

            Produit::create([
                'nom_produit' => $request->nom_produit,
                'description_produit' => $request->description_produit,
            ]);

            return redirect()->back()->with('success', 'Produit créé avec succès.');
        }

        if ($request->type === 'varietee') {
            $request->validate([
                'nom_varietee' => 'required|string',
                'produit_id' => 'required|exists:produits,id',
            ]);

            Varietee::create([
                'nom_varietee' => $request->nom_varietee,
                'caracteristique_varietee' => $request->caracteristique_varietee,
                'produit_id' => $request->produit_id,
            ]);

            return redirect()->back()->with('success', 'Variété créée avec succès.');
        }
    }

    /* EDITION PRODUIT OU VARIETE */
    public function edit(Request $request, $id)
    {
        if ($request->type === 'produit') {
            $produit = Produit::findOrFail($id);
            return view('produit-varietee.index', compact('produit'));
        }

        if ($request->type === 'varietee') {
            $varietee = Varietee::findOrFail($id);
            $produits = Produit::all(); // pour choisir le produit associé
            return view('produit-varietee.index', compact('varietee', 'produits'));
        }
    }

    /* MODIFICATION PRODUIT OU VARIETE */
    public function update(Request $request, $id)
    {
        if ($request->type === 'produit') {
            $request->validate([
                'nom_produit' => 'required|string',
                'description_produit' => 'required|string',
            ]);

            $produit = Produit::findOrFail($id);
            $produit->update([
                'nom_produit' => $request->nom_produit,
                'description_produit' => $request->description_produit,
            ]);

            return redirect()->route('produit-varietee.index')->with('success', 'Produit modifié avec succès.');
        }

        if ($request->type === 'varietee') {
            $request->validate([
                'nom_varietee' => 'required|string',
                'produit_id' => 'required|exists:produits,id',
            ]);

            $varietee = Varietee::findOrFail($id);
            $varietee->update([
                'nom_varietee' => $request->nom_varietee,
                'caracteristique_varietee' => $request->caracteristique_varietee,
                'produit_id' => $request->produit_id,
            ]);

            return redirect()->route('produit-varietee.index')->with('success', 'Variété modifiée avec succès.');
        }
    }

    /* SUPPRESSION PRODUIT OU VARIETE */
    public function destroy(Request $request, $id)
    {
        if ($request->type === 'produit') {
            $produit = Produit::findOrFail($id);
            $produit->delete();

            return redirect()->back()->with('success', 'Produit supprimé avec succès.');
        }

        if ($request->type === 'varietee') {
            $varietee = Varietee::findOrFail($id);
            $varietee->delete();

            return redirect()->back()->with('success', 'Variété supprimée avec succès.');
        }
    }
}
