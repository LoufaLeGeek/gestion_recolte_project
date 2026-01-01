<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $mois = $request->get('mois');
        $produitId = $request->get(key: 'produit');
        $varieteeId = $request->get('varietee');



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

        $recoltesParMois = (clone $query)
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
}
