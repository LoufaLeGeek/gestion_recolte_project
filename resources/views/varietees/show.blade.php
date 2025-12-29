@extends('app')

@section('title', $varietee->nom_varietee)
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><a href="{{ route('varietees.index') }}"><i class="fas fa-leaf me-2 text-sm"></i> <span class="text-sm">Liste des variétés</span></a></li>
    <li><i class="fas fa-eye me-2 text-sm"></i> <span class="text-sm">{{ $varietee->nom_varietee }}</span></li>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-2 sm:px-4">
    <!-- En-tête détaillée -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="avatar placeholder">
                    <div class="bg-green-100 text-green-600 rounded-full w-12 h-12">
                        <i class="fas fa-leaf text-lg"></i>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $varietee->nom_varietee }}</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="badge badge-success badge-sm">Variété active</span>
                        <span class="text-gray-500 text-xs">ID: #{{ $varietee->id }}</span>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 mt-2 md:mt-0">
                <a href="{{ route('varietees.edit', $varietee) }}" class="btn btn-warning btn-sm gap-1">
                    <i class="fas fa-edit text-xs"></i>
                    <span class="text-xs">Modifier</span>
                </a>
                <a href="{{ route('varietees.index') }}" class="btn btn-ghost btn-sm gap-1">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span class="text-xs">Retour</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Grille d'informations -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Colonne principale -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Produit associé -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body p-3 sm:p-4">
                    <h2 class="card-title text-base">
                        <i class="fas fa-carrot text-orange-500 text-sm"></i>
                        Produit associé
                    </h2>
                    <div class="mt-2">
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="bg-orange-100 text-orange-600 rounded-full w-10 h-10">
                                    <i class="fas fa-carrot"></i>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('produits.show', $varietee->produit_id) }}"
                                   class="font-bold text-blue-600 hover:text-blue-800 text-sm">
                                    {{ $varietee->produit->nom_produit ?? 'Produit non trouvé' }}
                                </a>
                                <p class="text-gray-600 text-xs mt-1">
                                    {{ $varietee->produit->description_produit ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Caractéristiques -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body p-3 sm:p-4">
                    <h2 class="card-title text-base">
                        <i class="fas fa-align-left text-blue-500 text-sm"></i>
                        Caractéristiques
                    </h2>
                    <div class="mt-2">
                        <p class="text-gray-700 text-sm whitespace-pre-line">{{ $varietee->caracteristique_varietee }}</p>
                    </div>
                </div>
            </div>

            <!-- Informations générales -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body p-3 sm:p-4">
                    <h2 class="card-title text-base">
                        <i class="fas fa-info-circle text-purple-500 text-sm"></i>
                        Informations générales
                    </h2>
                    <div class="space-y-3 mt-2">
                        <div class="flex justify-between items-center py-2 border-b border-base-200">
                            <span class="font-medium text-sm">Identifiant</span>
                            <span class="badge badge-outline badge-sm">#{{ $varietee->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-base-200">
                            <span class="font-medium text-sm">Produit ID</span>
                            <span class="font-mono text-xs">#{{ $varietee->produit_id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium text-sm">Longueur description</span>
                            <span class="font-mono text-xs">{{ strlen($varietee->caracteristique_varietee) }} caractères</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne latérale -->
        <div class="space-y-4">
            <!-- Dates -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body p-3 sm:p-4">
                    <h2 class="card-title text-base">
                        <i class="fas fa-history text-green-500 text-sm"></i>
                        Historique
                    </h2>
                    <div class="space-y-3 mt-2">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-calendar-plus text-blue-500 text-xs"></i>
                                <span class="font-medium text-sm">Création</span>
                            </div>
                            <div class="text-gray-700 text-sm">{{ $varietee->created_at->format('d/m/Y') }}</div>
                            <div class="text-gray-500 text-xs">{{ $varietee->created_at->format('H:i:s') }}</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-calendar-check text-green-500 text-xs"></i>
                                <span class="font-medium text-sm">Dernière modification</span>
                            </div>
                            <div class="text-gray-700 text-sm">{{ $varietee->updated_at->format('d/m/Y') }}</div>
                            <div class="text-gray-500 text-xs">{{ $varietee->updated_at->format('H:i:s') }}</div>
                        </div>
                        <div class="text-center mt-2">
                            <div class="stat-desc text-xs">
                                Créé il y a {{ $varietee->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="card bg-base-100 shadow-md">
                <div class="card-body p-3 sm:p-4">
                    <h2 class="card-title text-base">
                        <i class="fas fa-bolt text-yellow-500 text-sm"></i>
                        Actions rapides
                    </h2>
                    <div class="space-y-2 mt-2">
                        <a href="{{ route('varietees.edit', $varietee) }}" class="btn btn-warning btn-outline btn-sm w-full justify-start gap-1">
                            <i class="fas fa-edit text-xs"></i>
                            <span class="text-xs">Modifier cette variété</span>
                        </a>
                        <a href="{{ route('varietees.create') }}" class="btn btn-success btn-outline btn-sm w-full justify-start gap-1">
                            <i class="fas fa-plus text-xs"></i>
                            <span class="text-xs">Créer une nouvelle</span>
                        </a>
                        <a href="{{ route('varietees.index') }}" class="btn btn-ghost btn-sm w-full justify-start gap-1">
                            <i class="fas fa-list text-xs"></i>
                            <span class="text-xs">Voir toutes les variétés</span>
                        </a>
                        <a href="{{ route('produits.show', $varietee->produit_id) }}" class="btn btn-info btn-outline btn-sm w-full justify-start gap-1">
                            <i class="fas fa-carrot text-xs"></i>
                            <span class="text-xs">Voir le produit</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="stats stats-vertical shadow w-full text-xs">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <i class="fas fa-leaf text-lg"></i>
                    </div>
                    <div class="stat-title">Type</div>
                    <div class="stat-value text-primary text-lg">Variété</div>
                    <div class="stat-desc">de {{ $varietee->produit->nom_produit ?? 'Produit' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex flex-col sm:flex-row gap-2 justify-center">
        <a href="{{ route('varietees.edit', $varietee) }}" class="btn btn-warning btn-sm gap-1 flex-1">
            <i class="fas fa-edit text-xs"></i>
            <span class="text-xs">Modifier</span>
        </a>
        <form action="{{ route('varietees.destroy', $varietee) }}"
              method="POST"
              class="flex-1"
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette variété ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-sm gap-1 w-full">
                <i class="fas fa-trash text-xs"></i>
                <span class="text-xs">Supprimer</span>
            </button>
        </form>
        <a href="{{ route('varietees.index') }}" class="btn btn-ghost btn-sm gap-1 flex-1">
            <i class="fas fa-arrow-left text-xs"></i>
            <span class="text-xs">Retour à la liste</span>
        </a>
    </div>
</div>
@endsection
