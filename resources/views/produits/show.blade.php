@extends('app')

@section('title', $produit->nom_produit)
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2"></i> <span>Produits & Variétés</span></li>
    <li><a href="{{ route('produits.index') }}"><i class="fas fa-list me-2"></i> <span>Liste des produits</span></a></li>
    <li><i class="fas fa-eye me-2"></i> <span>{{ $produit->nom_produit }}</span></li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- En-tête détaillée -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="avatar placeholder">
                    <div class="bg-orange-100 text-orange-600 rounded-full w-14 h-14">
                        <i class="fas fa-carrot text-2xl"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $produit->nom_produit }}</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="badge badge-success">Produit actif</span>
                        <span class="text-gray-500 text-sm">ID: #{{ $produit->id }}</span>
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning gap-2">
                    <i class="fas fa-edit"></i>
                    Modifier
                </a>
                <a href="{{ route('produits.index') }}" class="btn btn-ghost gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </div>
        </div>
    </div>

    <!-- Grille d'informations -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Colonne principale -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">
                        <i class="fas fa-align-left text-green-500"></i>
                        Description
                    </h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $produit->description_produit }}</p>
                    </div>
                </div>
            </div>

            <!-- Informations générales -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">
                        <i class="fas fa-info-circle text-blue-500"></i>
                        Informations générales
                    </h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-base-200">
                            <span class="font-medium">Identifiant</span>
                            <span class="badge badge-outline">#{{ $produit->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-base-200">
                            <span class="font-medium">Statut</span>
                            <span class="badge badge-success">Actif</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-base-200">
                            <span class="font-medium">Longueur de la description</span>
                            <span class="font-mono">{{ strlen($produit->description_produit) }} caractères</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne latérale -->
        <div class="space-y-6">
            <!-- Dates -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">
                        <i class="fas fa-history text-purple-500"></i>
                        Historique
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-calendar-plus text-blue-500"></i>
                                <span class="font-medium">Création</span>
                            </div>
                            <div class="text-gray-700">{{ $produit->created_at->format('d/m/Y') }}</div>
                            <div class="text-gray-500 text-sm">{{ $produit->created_at->format('H:i:s') }}</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-calendar-check text-green-500"></i>
                                <span class="font-medium">Dernière modification</span>
                            </div>
                            <div class="text-gray-700">{{ $produit->updated_at->format('d/m/Y') }}</div>
                            <div class="text-gray-500 text-sm">{{ $produit->updated_at->format('H:i:s') }}</div>
                        </div>
                        <div class="text-center mt-4">
                            <div class="stat-desc">
                                Créé il y a {{ $produit->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">
                        <i class="fas fa-bolt text-yellow-500"></i>
                        Actions rapides
                    </h2>
                    <div class="space-y-3">
                        <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning btn-outline w-full justify-start gap-2">
                            <i class="fas fa-edit"></i>
                            Modifier ce produit
                        </a>
                        <a href="{{ route('produits.create') }}" class="btn btn-success btn-outline w-full justify-start gap-2">
                            <i class="fas fa-plus"></i>
                            Créer un nouveau
                        </a>
                        <a href="{{ route('produits.index') }}" class="btn btn-ghost w-full justify-start gap-2">
                            <i class="fas fa-list"></i>
                            Voir tous les produits
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="stats stats-vertical shadow w-full">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <i class="fas fa-carrot text-2xl"></i>
                    </div>
                    <div class="stat-title">Type</div>
                    <div class="stat-value text-primary">Produit</div>
                    <div class="stat-desc">Agriculture</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning gap-2 flex-1">
            <i class="fas fa-edit"></i>
            Modifier
        </a>
        <form action="{{ route('produits.destroy', $produit) }}"
              method="POST"
              class="flex-1"
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error gap-2 w-full">
                <i class="fas fa-trash"></i>
                Supprimer
            </button>
        </form>
        <a href="{{ route('produits.index') }}" class="btn btn-ghost gap-2 flex-1">
            <i class="fas fa-arrow-left"></i>
            Retour à la liste
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .prose {
        color: #374151;
    }
    .prose p {
        margin-top: 0.5em;
        margin-bottom: 0.5em;
    }
</style>
@endpush
