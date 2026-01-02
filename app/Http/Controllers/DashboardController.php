<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Recolte;
use App\Models\Vente;
use App\Models\PrixVarietee;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $mois = $request->get('mois');
        $produitId = $request->get(key: 'produit');
        $varieteeId = $request->get('varietee');


        // Les queries de base pour les KPIs et graphiques
        $queryRecolteVarieteeProduit = DB::table('recoltes')
            ->join('varietees', 'recoltes.varietee_id', '=', 'varietees.id')
            ->join('produits', 'varietees.produit_id', '=', 'produits.id');


        // Base query
        $query = DB::table('recoltes')
            ->join('varietees', 'recoltes.varietee_id', '=', 'varietees.id')
            ->join('produits', 'varietees.produit_id', '=', 'produits.id');

        // Filtre mois (SQLite)
        if ($mois) {
            $query->whereRaw('strftime("%Y-%m", date_recolte) = ?', [$mois]);
        }

        // Filtre produit
        if ($produitId) {
            $query->where('produits.id', $produitId);
            $queryRecolteVarieteeProduit->where('produits.id', $produitId);
        }

        // KPI
        $totalRecolte = (clone $query)->sum('quantite_recolte');
        $nbRecoltes = (clone $query)->count();
        $moyenneRecolte = (clone $query)->avg('quantite_recolte');
        $moyenneRecolte = round($moyenneRecolte, 2);
        $chiffreAffaires = DB::table('ventes')->sum('montant_totale');
        $totalePertes = DB::table('pertes')->sum('quantite_perdu');
        $quantiteStockee = DB::table('stocks')->sum('quantite_actuelle');


        // Graphique par produit
        $recoltesParProduit = (clone $query)
            ->select(
                'produits.nom_produit',
                DB::raw('SUM(recoltes.quantite_recolte) as total')
            )
            ->groupBy('produits.nom_produit')
            ->get();

        $recoltesParMois = (clone $queryRecolteVarieteeProduit)
            ->selectRaw('strftime("%Y-%m", date_recolte) as mois, SUM(quantite_recolte) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
        // Liste mois
        $moisDisponibles = DB::table('recoltes')
            ->selectRaw('strftime("%Y-%m", date_recolte) as mois')
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('mois');

        // Liste produits
        $produits = DB::table('produits')->get();
        $varietees = DB::table('varietees')->get();

        return view('dashboard.index', compact(
            'totalRecolte',
            'nbRecoltes',
            'totalePertes',
            'moyenneRecolte',
            'chiffreAffaires',
            'quantiteStockee',
            'recoltesParProduit',
            'recoltesParMois',
            'moisDisponibles',
            'produits',
            'mois',
            'produitId',
            'varietees',
            'varieteeId'

        ));
    }


    public function data()
    {
        $prixParVarietee = PrixVarietee::query()
            ->join('varietees', 'prix_varietees.varietee_id', '=', 'varietees.id')
            ->select(
                'varietees.nom_varietee as varietee',
                'prix_varietees.date_debut',
                'prix_varietees.prix'
            )
            ->orderBy('prix_varietees.date_debut')
            ->get()
            ->groupBy('varietee');

        return response()->json([
            'prixParVarietee' => $prixParVarietee
        ]);
    }



public function ventesData()
{
    $ventes = DB::table('ventes')
        ->selectRaw('DATE(date_vente) as date, SUM(montant_totale) as total')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    return response()->json([
        'ventes' => $ventes
    ]);
}

public function ventesParVarietee()
{
    $ventes = DB::table('ventes')
        ->join('varietees', 'ventes.varietee_id', '=', 'varietees.id')
        ->select(
            'varietees.nom_varietee as varietee',
            DB::raw('DATE(ventes.date_vente) as date'),
            DB::raw('SUM(ventes.montant_totale) as total')
        )
        ->groupBy('varietee', 'date')
        ->orderBy('date')
        ->get()
        ->groupBy('varietee');

    return response()->json([
        'ventesParVarietee' => $ventes
    ]);
}

}
