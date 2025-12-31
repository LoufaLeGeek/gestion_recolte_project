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
        // Récupère toutes les variétés avec leur produit associé, triées par nom (A → Z)
        $liste_varietees = Varietee::with('produit')
            ->orderBy('nom_varietee', 'asc')
            ->get();

        // Récupère les récoltes avec leur variété et produit associés, avec filtrage optionnel par variété

        $recoltes = Recolte::with(['varietee.produit'])
            ->when($request->varietee_id, fn($q) => $q->where('varietee_id', $request->varietee_id))
            ->orderBy('date_recolte', 'desc')
            ->paginate(5);

        // Calcul des statistiques : somme des quantités par variété
        $statistiques = Recolte::selectRaw('varietee_id, SUM(quantite_recolte) as total_quantite')
            ->groupBy('varietee_id')
            ->with(['varietee.produit'])
            ->get();

        // Retourne la vue 'recoltes.index' avec les données compactées
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
        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'date_recolte'     => 'required|date',          // La date est obligatoire et doit être valide
            'quantite_recolte' => 'required|numeric|min:0', // La quantité est obligatoire, numérique et >= 0
            'varietee_id'      => 'required|exists:varietees,id', // La variété doit exister dans la table varietees
        ]);

        // Création de la récolte avec les données validées
        Recolte::create($validated);

        // Redirection vers la page des récoltes avec message de succès
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
        // Récupère la récolte par son ID ou renvoie une erreur 404
        $recolte = Recolte::findOrFail($id);

        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'date_recolte'     => 'required|date',
            'quantite_recolte' => 'required|numeric|min:0',
            'varietee_id'      => 'required|exists:varietees,id',
        ]);

        // Mise à jour de la récolte avec les données validées
        $recolte->update($validated);

        // Redirection vers la page des récoltes avec message de succès
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
        // Récupère la récolte par son ID ou renvoie une erreur 404, puis supprime
        Recolte::findOrFail($id)->delete();

        // Redirection vers la page des récoltes avec message de succès
        return redirect()->route('recoltes.index')->with('success', 'Récolte supprimée avec succès.');
    }
}
