<?php

namespace App\Http\Controllers;

use App\Models\Recolte;
use Illuminate\Http\Request;
use App\Models\Varietee;


class RecolteController extends Controller
{
    /**
     * Affiche la liste des récoltes avec filtrage et statistiques
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $liste_varietees = Varietee::with('produit')
            ->orderBy('nom_varietee', 'asc')
            ->get();
        $recoltes = Recolte::with(['varietee.produit'])
            ->when($request->varietee_id, fn($q) => $q->where('varietee_id', $request->varietee_id))
            ->orderBy('id', 'asc')
            ->paginate(15);

        $statistiques = Recolte::selectRaw('varietee_id, SUM(quantite_recolte) as total_quantite')
            ->groupBy('varietee_id')
            ->with(['varietee.produit'])
            ->get();

        return view('recoltes.index', compact('recoltes', 'liste_varietees', 'statistiques'));
    }

    /**
     * Ajoute une nouvelle récolte
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_recolte'     => 'required|date',
            'quantite_recolte' => 'required|numeric|min:0',
            'varietee_id'      => 'required|exists:varietees,id',
        ]);

        Recolte::create($validated);
        return redirect()->route('recoltes.index')->with('success', 'Récolte ajoutée avec succès.');
    }

    /**
     * Modifie une récolte existante
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $recolte = Recolte::findOrFail($id);
        $validated = $request->validate([
            'date_recolte'     => 'required|date',
            'quantite_recolte' => 'required|numeric|min:0',
            'varietee_id'      => 'required|exists:varietees,id',
        ]);
        $recolte->update($validated);
        return redirect()->route('recoltes.index')->with('success', 'Récolte modifiée avec succès.');
    }

    /**
     * Supprime une récolte existante
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        Recolte::findOrFail($id)->delete();
        return redirect()->route('recoltes.index')->with('success', 'Récolte supprimée avec succès.');
    }
}
