<?php

namespace App\Http\Controllers;

use App\Models\Varietee;
use App\Models\Produit;

use Illuminate\Http\Request;

class VarieteeProduitController extends Controller
{
    /* PAGE PRINCIPALE*/
    public function index()
    {
        $produits = Produit::with('varietees')->get();
        return view('produit-varietee.index', compact('produits'));
    }

    /*CREATION DES VARIETEES ET PRODUITS */

    public function store(Request $request)
    {
        //CREATION PRODUIT

        if($request->type === 'produit'){
            $request->validate([
                'nom_produit' => 'required|string',
            ]);

            Produit::create([
                'nom_produit' => $request->nom_produit,
                'caracteristique_vaietee'=> $request->caracteristique_vaietee,
                'produit_id'=> $request
            ]);

            return redirect()->back()->with('success', 'Produit créé avec succès.');
        }


        //CREATION VARIETEE

        if($request->type === 'varietee'){
            $request->validate([
                'nom_varietee' => 'required|string',
                'produit_id' => 'required|exists:produits,id',
            ]);

            Varietee::create([
                'nom_varietee' => $request->nom_varietee,
                'caracteristique_varietee'=> $request->caracteristique_varietee,
                'produit_id'=> $request->produit_id
            ]);

            return redirect()->back()->with('success', 'Variété créée avec succès.');
        }

    }

    //MODIFICATION DES VARIETEES ET PRODUITS

    public function update(Request $request, $id)
    {
        //MODIFICATION PRODUIT

        if($request->type === 'produit'){
            $request->validate([
                'nom_produit' => 'required|string',
            ]);

            $produit = Produit::findOrFail($id);
            $produit->update([
                'nom_produit' => $request->nom_produit,
                'description_produit'=> $request->description_produit,
            ]);

            return redirect()->back()->with('success', 'Produit modifié avec succès.');
        }

        //MODIFICATION VARIETEE

        if($request->type === 'varietee'){
            $request->validate([
                'nom_varietee' => 'required|string',
                'produit_id' => 'required|exists:produits,id',
            ]);

            $varietee = Varietee::findOrFail($id);
            $varietee->update([
                'nom_varietee' => $request->nom_varietee,
                'caracteristique_varietee'=> $request->caracteristique_varietee,
                'produit_id'=> $request->produit_id
            ]);

            return redirect()->back()->with('success', 'Variété modifiée avec succès.');
        }
    }

    //SUPPRESSION DES VARIETEES ET PRODUITS

    public function destroy(Request $request, $id)
    {
        //SUPPRESSION PRODUIT

        if($request->type === 'produit'){
            $produit = Produit::findOrFail($id);
            $produit->delete();

            return redirect()->back()->with('success', 'Produit supprimé avec succès.');
        }

        //SUPPRESSION VARIETEE

        if($request->type === 'varietee'){
            $varietee = Varietee::findOrFail($id);
            $varietee->delete();

            return redirect()->back()->with('success', 'Variété supprimée avec succès.');
        }
    }

}
