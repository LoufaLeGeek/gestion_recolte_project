@extends('app')

@section('title', $varietee->nom_varietee)
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><a href="{{ route('varietees.index') }}"><i class="fas fa-leaf me-2 text-sm"></i> <span class="text-sm">Liste des
                variétés</span></a></li>
    <li><i class="fas fa-eye me-2 text-sm"></i> <span class="text-sm">{{ $varietee->nom_varietee }}</span></li>
@endsection

@section('content')
    <div class="max-w-5xl mx-auto px-2 sm:px-4">
        <!-- En-tête détaillée -->
        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                        <div class="flex items-center justify-center bg-green-100 text-green-600 rounded-full w-12 h-12">
                            <i class="fas fa-leaf text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $varietee->nom_varietee }}</h1>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="badge badge-success badge-sm">Variété active</span>
                            <!-- Dans l'en-tête, après le badge "Variété active" -->
@if($varietee->prix_actuelle)
    <span class="badge badge-lg bg-green-100 text-green-800 border-green-300">
        <i class="fas fa-money-bill-wave me-1"></i>
        {{ number_format($varietee->prix_actuelle->prix, 0, ',', ' ') }} FCFA
    </span>
@else
    <span class="badge badge-lg bg-gray-100 text-gray-800 border-gray-300">
        <i class="fas fa-money-bill-slash me-1"></i>
        Prix non défini
    </span>
@endif
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
                                    <div class="flex items-center justify-center bg-orange-100 text-orange-600 rounded-full w-10 h-10">
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
                            <p class="text-gray-700 text-sm whitespace-pre-line">{{ $varietee->caracteristique_varietee }}
                            </p>
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
                                <span class="font-mono text-xs">{{ strlen($varietee->caracteristique_varietee) }}
                                    caractères</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Prix actuel -->
                <div class="card bg-base-100 shadow-md border-l-4 border-l-green-500">
                    <div class="card-body p-3 sm:p-4">
                        <h2 class="card-title text-base">
                            <i class="fas fa-money-bill-wave text-green-500 text-sm"></i>
                            Prix actuel
                        </h2>
                        <div class="mt-4">
                            @if ($varietee->prix_actuelle)
                                <!-- Grand affichage du prix -->
                                <div class="text-center mb-4">
                                    <div class="text-3xl sm:text-4xl font-bold text-green-600">
                                        {{ number_format($varietee->prix_actuelle->prix, 0, ',', ' ') }}
                                        <span class="text-lg">FCFA</span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">Prix unitaire</div>
                                </div>

                                <!-- Détails du prix -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3">
                                    <div class="bg-base-200 rounded p-3">
                                        <div class="flex items-center gap-2 mb-1">
                                            <i class="fas fa-calendar-check text-blue-500 text-xs"></i>
                                            <span class="font-medium text-xs">Date d'effet</span>
                                        </div>
                                        <div class="text-gray-700 text-sm">
                                            {{ $varietee->prix_actuelle->date_debut->format('d/m/Y') }}
                                        </div>
                                        <div class="text-gray-500 text-xs mt-1">
                                            {{ $varietee->prix_actuelle->date_debut->diffForHumans() }}
                                        </div>
                                    </div>

                                    <div class="bg-base-200 rounded p-3">
                                        <div class="flex items-center gap-2 mb-1">
                                            <i class="fas fa-clock text-purple-500 text-xs"></i>
                                            <span class="font-medium text-xs">Durée</span>
                                        </div>
                                        <div class="text-gray-700 text-sm">
                                            {{ $varietee->prix_actuelle->date_debut->diffInDays(now()) }} jours
                                        </div>
                                        <div class="text-gray-500 text-xs mt-1">
                                            En vigueur
                                        </div>
                                    </div>
                                </div>

                                <!-- Badge statut -->
                                <div class="mt-4 flex justify-center">
                                    <span class="badge badge-success badge-sm gap-1">
                                        <i class="fas fa-check-circle text-xs"></i>
                                        Prix actif
                                    </span>
                                </div>
                            @else
                                <!-- Aucun prix défini -->
                                <div class="text-center py-6">
                                    <div class="avatar placeholder mx-auto">
                                        <div class="bg-gray-100 text-gray-400 rounded-full w-16 h-16">
                                            <i class="fas fa-money-bill-slash text-xl"></i>
                                        </div>
                                    </div>
                                    <h3 class="font-medium text-gray-600 mt-3">Aucun prix défini</h3>
                                    <p class="text-gray-500 text-xs mt-1">Cette variété n'a pas encore de prix actuel</p>

                                    <div class="mt-4">
                                        <a href="{{ route('varietees.edit', $varietee) }}#prix"
                                            class="btn btn-success btn-sm gap-1">
                                            <i class="fas fa-plus text-xs"></i>
                                            <span class="text-xs">Définir un prix</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
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
                            <a href="{{ route('varietees.edit', $varietee) }}"
                                class="btn btn-warning btn-outline btn-sm w-full justify-start gap-1">
                                <i class="fas fa-edit text-xs"></i>
                                <span class="text-xs">Modifier cette variété</span>
                            </a>
                            <a href="{{ route('varietees.create') }}"
                                class="btn btn-success btn-outline btn-sm w-full justify-start gap-1">
                                <i class="fas fa-plus text-xs"></i>
                                <span class="text-xs">Créer une nouvelle</span>
                            </a>
                            <a href="{{ route('varietees.index') }}"
                                class="btn btn-ghost btn-sm w-full justify-start gap-1">
                                <i class="fas fa-list text-xs"></i>
                                <span class="text-xs">Voir toutes les variétés</span>
                            </a>
                            <a href="{{ route('produits.show', $varietee->produit_id) }}"
                                class="btn btn-info btn-outline btn-sm w-full justify-start gap-1">
                                <i class="fas fa-carrot text-xs"></i>
                                <span class="text-xs">Voir le produit</span>
                            </a>
                        </div>
                    </div>

                </div>


                <!-- Historique des prix (Optionnel) -->
                <div class="card bg-base-100 shadow-md">
                    <div class="card-body p-3 sm:p-4">
                        <h2 class="card-title text-base">
                            <i class="fas fa-chart-line text-purple-500 text-sm"></i>
                            Historique des prix
                        </h2>
                        <div class="mt-2">
                            @if ($varietee->prix_varietees && $varietee->prix_varietees->count() > 0)
                                <!-- Afficher les 3 derniers prix -->
                                <div class="space-y-3">
                                    @foreach ($varietee->prix_varietees->sortByDesc('date_debut')->take(3) as $prix)
                                        <div
                                            class="flex items-center justify-between p-2 rounded hover:bg-base-200
                                    {{ !$prix->date_fin ? 'bg-green-50 border-l-4 border-l-green-500' : '' }}">
                                            <div>
                                                <div class="font-bold text-sm">
                                                    {{ number_format($prix->prix, 0, ',', ' ') }} FCFA
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    @if ($prix->date_fin)
                                                        Du {{ $prix->date_debut->format('d/m/Y') }}
                                                        au {{ $prix->date_fin->format('d/m/Y') }}
                                                    @else
                                                        en cour depuis le {{ $prix->date_debut->format('d/m/Y') }}
                                                    @endif
                                                </div>
                                            </div>
                                            @if (!$prix->date_fin)
                                                <span class="badge badge-success badge-xs">
                                                    Actuel
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach

                                    <!-- Lien vers l'historique complet -->
                                    @if ($varietee->prix_varietees->count() > 3)
                                        <div class="text-center pt-2">
                                            <a href="#" class="text-xs text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-history me-1"></i>
                                                Voir l'historique complet ({{ $varietee->prix_varietees->count() }}
                                                entrées)
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-chart-line text-gray-300 text-xl mb-2"></i>
                                    <p class="text-gray-500 text-xs">Aucun historique de prix</p>
                                </div>
                            @endif
                        </div>
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
            <form action="{{ route('varietees.destroy', $varietee) }}" method="POST" class="flex-1"
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
