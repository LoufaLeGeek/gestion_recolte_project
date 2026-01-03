<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Recolte;
use App\Models\Vente;
use App\Models\PrixVarietee;
use App\Models\Varietee;

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


        // Base queryVentes
        $queryVentes = DB::table('ventes')
            ->join('varietees', 'ventes.varietee_id', '=', 'varietees.id')
            ->join('produits', 'varietees.produit_id', '=', 'produits.id');
        // Filtre mois (SQLite)
        if ($mois) {
            $query->whereRaw('strftime("%Y-%m", date_recolte) = ?', [$mois]);
        }

        // if ($mois) {
        //     $query->whereRaw(
        //         "TO_CHAR(date_recolte, 'YYYY-MM') = ?",
        //         [$mois]
        //     );
        // }

        // Filtre produit
        if ($produitId) {
            $query->where('produits.id', $produitId);
            $queryRecolteVarieteeProduit->where('produits.id', $produitId);
            $queryVentes->where('produits.id', $produitId);
        }

        // Filtre Varietee
        if ($varieteeId) {
            $query->where('varietees.id', $varieteeId);
            $queryRecolteVarieteeProduit->where('varietees.id', $varieteeId);
            $queryVentes->where('varietees.id', $varieteeId);
        }

        // KPI
        $totalRecolte = (clone $query)->sum('quantite_recolte');
        $nbRecoltes = (clone $query)->count();
        $moyenneRecolte = (clone $query)->avg('quantite_recolte');
        $moyenneRecolte = round($moyenneRecolte, 2);
        $chiffreAffaires = (clone $queryVentes)->sum('montant_totale');
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

        // $recoltesParMois = (clone $queryRecolteVarieteeProduit)
        //     ->selectRaw('strftime("%Y-%m", date_recolte) as mois, SUM(quantite_recolte) as total')
        //     ->groupBy('mois')
        //     ->orderBy('mois')
        //     ->get();


        $recoltesParMois = (clone $queryRecolteVarieteeProduit)
            ->selectRaw("TO_CHAR(date_recolte, 'YYYY-MM') AS mois, SUM(quantite_recolte) AS total")
            ->groupByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
            ->orderByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
            ->get();

        // $recoltesParMois = (clone $queryRecolteVarieteeProduit)
        //     ->selectRaw("
        // TO_CHAR(date_recolte, 'YYYY-MM') AS mois,
        // SUM(quantite_recolte) AS total
        //     ")
        //     ->groupByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
        //     ->orderByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
        //     ->get();

        // Liste mois
        // $moisDisponibles = DB::table('recoltes')
        //     ->selectRaw('strftime("%Y-%m", date_recolte) as mois')
        //     ->groupBy('mois')
        //     ->orderBy('mois')
        //     ->pluck('mois');

        $moisDisponibles = DB::table('recoltes')
            ->selectRaw("TO_CHAR(date_recolte, 'YYYY-MM') AS mois")
            ->groupByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
            ->orderByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
            ->pluck('mois');

        // $moisDisponibles = DB::table('recoltes')
        //     ->selectRaw("TO_CHAR(date_recolte, 'YYYY-MM') AS mois")
        //     ->groupByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
        //     ->orderByRaw("TO_CHAR(date_recolte, 'YYYY-MM')")
        //     ->pluck('mois');

        // Liste produits
        $produits = DB::table('produits')->get();
        $varietees = Varietee::where('varietees.produit_id', $produitId)->get();

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


    public function data(Request $request)
    {
        $produitId = $request->get('produit');
        $varieteeId = $request->get('varietee');

        $query = PrixVarietee::query()
            ->join('varietees', 'prix_varietees.varietee_id', '=', 'varietees.id')
            ->join('produits', 'varietees.produit_id', '=', 'produits.id')
            ->select(
                'varietees.nom_varietee as varietee',
                'prix_varietees.date_debut',
                'prix_varietees.prix'
            );

        // 🔹 filtre produit
        if ($produitId) {
            $query->where('produits.id', $produitId);
        }

        // 🔹 filtre variété
        if ($varieteeId) {
            $query->where('varietees.id', $varieteeId);
        }

        $prixParVarietee = $query
            ->orderBy('prix_varietees.date_debut')
            ->get()
            ->groupBy('varietee');

        return response()->json([
            'prixParVarietee' => $prixParVarietee
        ]);
    }



    public function ventesData(Request $request)
    {
        $produitId = $request->get('produit');
        $varieteeId = $request->get('varietee');

        $query = DB::table('ventes')
            ->join('varietees', 'ventes.varietee_id', '=', 'varietees.id')
            ->join('produits', 'varietees.produit_id', '=', 'produits.id');

        if ($produitId) {
            $query->where('produits.id', $produitId);
        }
        if ($varieteeId) {
            $query->where('varietees.id', $varieteeId);
        }

        $ventes = $query
            ->selectRaw("TRUNC(ventes.date_vente) as date, SUM(ventes.montant_totale) as total")
            ->groupBy(DB::raw("TRUNC(ventes.date_vente)"))
            ->orderBy('date')
            ->get();

        return response()->json($ventes);
    }



    public function ventesEtRecoltes(Request $request)
    {
        $produitId = $request->get('produit');
        $varieteeId = $request->get('varietee');

        $recoltes = DB::table('recoltes')
            ->join('varietees', 'recoltes.varietee_id', '=', 'varietees.id')
            ->join('produits', 'varietees.produit_id', '=', 'produits.id')
            ->when($produitId, fn($q) => $q->where('produits.id', $produitId))
            ->when($varieteeId, fn($q) => $q->where('varietees.id', $varieteeId))
            ->selectRaw("TRUNC(recoltes.date_recolte) as date, SUM(recoltes.quantite_recolte) as total")
            ->groupBy(DB::raw("TRUNC(recoltes.date_recolte)"))
            ->orderBy('date')
            ->get();

        $ventes = DB::table('ventes')
            ->join('varietees', 'ventes.varietee_id', '=', 'varietees.id')
            ->join('produits', 'varietees.produit_id', '=', 'produits.id')
            ->when($produitId, fn($q) => $q->where('produits.id', $produitId))
            ->when($varieteeId, fn($q) => $q->where('varietees.id', $varieteeId))
            ->selectRaw("TRUNC(ventes.date_vente) as date, SUM(ventes.montant_totale) as total")
            ->groupBy(DB::raw("TRUNC(ventes.date_vente)"))
            ->orderBy('date')
            ->get();

        return response()->json([
            'recoltes' => $recoltes,
            'ventes' => $ventes
        ]);
    }



}
