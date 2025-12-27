@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li><span class="font-semibold">Dashboard</span></li>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Cartes avec DaisyUI -->
        <div class="card bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 shadow-lg">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="card-title text-green-700">Récoltes du jour</h3>
                        <p class="text-3xl font-bold text-green-800">1,234 kg</p>
                    </div>
                    <div class="avatar placeholder">
                        <div class="bg-green-100 text-green-600 rounded-full w-12 h-12">
                            <i class="fas fa-seedling text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-sm btn-outline btn-success">Voir détails</button>
                </div>
            </div>
        </div>

        <!-- Autres cartes... -->
    </div>

    <!-- Table avec DaisyUI -->
    <div class="card shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-green-700">Dernières récoltes</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr class="bg-green-50">
                            <th>Produit</th>
                            <th>Date</th>
                            <th>Quantité</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Données... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection