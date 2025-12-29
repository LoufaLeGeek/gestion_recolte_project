@extends('app')

@section('title', 'Gestion des Variétés')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><i class="fas fa-leaf me-2 text-sm"></i> <span class="text-sm">Liste des variétés</span></li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-2 sm:px-4">
    <!-- En-tête avec bouton -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Gestion des Variétés</h1>
            <p class="text-gray-600 text-sm mt-1">Gérez les variétés de vos produits agricoles</p>
        </div>
        <a href="{{ route('varietees.create') }}" class="btn btn-success btn-sm sm:btn-md gap-1">
            <i class="fas fa-plus text-xs sm:text-sm"></i>
            <span class="text-xs sm:text-sm">Nouvelle variété</span>
        </a>
    </div>

    <!-- Barre de recherche et filtres -->
    <div class="card bg-base-100 shadow-md mb-6">
        <div class="card-body p-3 sm:p-4">
            <form method="GET" action="{{ route('varietees.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Barre de recherche -->
                    <div class="form-control">
                        <label class="label py-1">
                            <span class="label-text font-semibold text-xs">
                                <i class="fas fa-search me-1 text-gray-500"></i>
                                Recherche
                            </span>
                        </label>
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="input input-bordered input-sm w-full pl-9"
                                   placeholder="Nom, caractéristiques, produit...">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Filtre par produit -->
                    <div class="form-control">
                        <label class="label py-1">
                            <span class="label-text font-semibold text-xs">
                                <i class="fas fa-filter me-1 text-gray-500"></i>
                                Filtrer par produit
                            </span>
                        </label>
                        <select name="produit_id"
                                class="select select-bordered select-sm w-full">
                            <option value="">Tous les produits</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}"
                                        {{ request('produit_id') == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->nom_produit }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tri -->
                    <div class="form-control">
                        <label class="label py-1">
                            <span class="label-text font-semibold text-xs">
                                <i class="fas fa-sort me-1 text-gray-500"></i>
                                Trier par
                            </span>
                        </label>
                        <select name="sort"
                                class="select select-bordered select-sm w-full mb-2">
                            <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>
                                Date de création
                            </option>
                            <option value="nom_varietee" {{ request('sort') == 'nom_varietee' ? 'selected' : '' }}>
                                Nom (A-Z)
                            </option>
                            <option value="produit_id" {{ request('sort') == 'produit_id' ? 'selected' : '' }}>
                                Produit
                            </option>
                        </select>
                        <select name="direction"
                                class="select select-bordered select-sm w-full">
                            <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>
                                Décroissant
                            </option>
                            <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>
                                Croissant
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Boutons de filtrage -->
                <div class="flex flex-col sm:flex-row gap-2 pt-2">
                    <button type="submit" class="btn btn-primary btn-sm flex-1 gap-1">
                        <i class="fas fa-filter text-xs"></i>
                        <span class="text-xs">Appliquer les filtres</span>
                    </button>

                    @if(request()->hasAny(['search', 'produit_id', 'sort', 'direction']))
                        <a href="{{ route('varietees.index') }}" class="btn btn-ghost btn-sm flex-1 gap-1">
                            <i class="fas fa-times text-xs"></i>
                            <span class="text-xs">Effacer les filtres</span>
                        </a>
                    @endif
                </div>
            </form>

            <!-- Indicateurs de filtres actifs -->
            @if(request()->hasAny(['search', 'produit_id']))
                <div class="mt-4 pt-3 border-t border-base-200">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-xs font-semibold text-gray-600">Filtres actifs :</span>

                        @if(request('search'))
                            <span class="badge badge-info badge-sm gap-1">
                                <i class="fas fa-search text-xs"></i>
                                Recherche: "{{ request('search') }}"
                                <a href="{{ route('varietees.index', array_merge(request()->except('search'), ['page' => 1])) }}"
                                   class="ml-1 text-white hover:text-gray-200">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('produit_id'))
                            @php
                                $selectedProduit = $produits->firstWhere('id', request('produit_id'));
                            @endphp
                            @if($selectedProduit)
                                <span class="badge badge-success badge-sm gap-1">
                                    <i class="fas fa-carrot text-xs"></i>
                                    Produit: {{ $selectedProduit->nom_produit }}
                                    <a href="{{ route('varietees.index', array_merge(request()->except('produit_id'), ['page' => 1])) }}"
                                       class="ml-1 text-white hover:text-gray-200">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            @endif
                        @endif

                        @if(request('sort') && request('sort') != 'created_at')
                            <span class="badge badge-warning badge-sm gap-1">
                                <i class="fas fa-sort text-xs"></i>
                                Tri: {{ request('sort') == 'nom_varietee' ? 'Nom' : 'Produit' }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Résultats de recherche -->
    <div class="mb-4">
        @if(request()->hasAny(['search', 'produit_id']))
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-700">
                    <i class="fas fa-list mr-1"></i>
                    {{ $varietees->total() }} variété(s) trouvée(s)
                </h2>

                <!-- Export optionnel -->
                <div class="flex gap-2">
                    <button class="btn btn-outline btn-sm gap-1" onclick="window.print()">
                        <i class="fas fa-print text-xs"></i>
                        <span class="text-xs">Imprimer</span>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Carte principale -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body p-3 sm:p-4">
            <!-- Tableau responsive -->
            <div class="overflow-x-auto -mx-2 sm:mx-0">
                @if($varietees->count() > 0)
                    <table class="table table-zebra table-sm sm:table-md">
                        <thead>
                            <tr class="bg-base-200">
                                <th class="font-semibold text-xs sm:text-sm py-2">
                                    <a href="{{ route('varietees.index', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'nom_varietee', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                       class="flex items-center gap-1 hover:text-primary">
                                        Nom de la variété
                                        @if(request('sort') == 'nom_varietee')
                                            <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }} text-xs"></i>
                                        @else
                                            <i class="fas fa-sort text-xs opacity-50"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="font-semibold text-xs sm:text-sm py-2">
                                    <a href="{{ route('varietees.index', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'produit_id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                       class="flex items-center gap-1 hover:text-primary">
                                        Produit associé
                                        @if(request('sort') == 'produit_id')
                                            <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }} text-xs"></i>
                                        @else
                                            <i class="fas fa-sort text-xs opacity-50"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="font-semibold text-xs sm:text-sm py-2">Caractéristiques</th>
                                <th class="font-semibold text-xs sm:text-sm py-2">
                                    <a href="{{ route('varietees.index', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                       class="flex items-center gap-1 hover:text-primary">
                                        Créé le
                                        @if(request('sort') == 'created_at' || !request()->has('sort'))
                                            <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }} text-xs"></i>
                                        @else
                                            <i class="fas fa-sort text-xs opacity-50"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="font-semibold text-xs sm:text-sm py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($varietees as $varietee)
                                <tr class="hover:bg-base-100 transition-colors">
                                    <td class="py-2">
                                        <div class="flex items-center gap-2">
                                            <div class="avatar placeholder">
                                                <div class="bg-green-100 text-green-600 rounded-full w-6 h-6">
                                                    <i class="fas fa-leaf text-xs"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-xs sm:text-sm">{{ $varietee->nom_varietee }}</span>
                                                <div class="text-gray-500 text-xs">#{{ $varietee->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <div class="flex items-center gap-2">
                                            <div class="avatar placeholder">
                                                <div class="bg-orange-100 text-orange-600 rounded-full w-6 h-6">
                                                    <i class="fas fa-carrot text-xs"></i>
                                                </div>
                                            </div>
                                            <a href="{{ route('produits.show', $varietee->produit_id) }}"
                                               class="text-blue-600 hover:text-blue-800 text-xs sm:text-sm">
                                                {{ $varietee->produit->nom_produit ?? 'N/A' }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <div class="max-w-[150px] sm:max-w-xs">
                                            <span class="truncate-2-lines text-xs sm:text-sm">
                                                {{ $varietee->caracteristique_varietee }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <div class="text-xs">
                                            <div>{{ $varietee->created_at->format('d/m/Y') }}</div>
                                            <div class="text-gray-500">{{ $varietee->created_at->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <div class="flex gap-1 justify-center">
                                            <a href="{{ route('varietees.show', $varietee) }}"
                                               class="btn btn-info btn-xs sm:btn-sm gap-1"
                                               title="Voir détails">
                                                <i class="fas fa-eye text-xs"></i>
                                                <span class="hidden xs:inline text-xs">Voir</span>
                                            </a>
                                            <a href="{{ route('varietees.edit', $varietee) }}"
                                               class="btn btn-warning btn-xs sm:btn-sm gap-1"
                                               title="Modifier">
                                                <i class="fas fa-edit text-xs"></i>
                                                <span class="hidden xs:inline text-xs">Éditer</span>
                                            </a>
                                            <form action="{{ route('varietees.destroy', $varietee) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette variété ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-error btn-xs sm:btn-sm gap-1"
                                                        title="Supprimer">
                                                    <i class="fas fa-trash text-xs"></i>
                                                    <span class="hidden xs:inline text-xs">Supprimer</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <!-- Message aucun résultat -->
                    <div class="text-center py-8">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <div class="avatar placeholder">
                                <div class="bg-base-200 text-base-400 rounded-full w-16 h-16">
                                    <i class="fas fa-search text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700">
                                    @if(request()->hasAny(['search', 'produit_id']))
                                        Aucune variété ne correspond à vos critères
                                    @else
                                        Aucune variété trouvée
                                    @endif
                                </h3>
                                <p class="text-gray-500 text-xs mt-1">
                                    @if(request()->hasAny(['search', 'produit_id']))
                                        Essayez de modifier vos filtres de recherche
                                    @else
                                        Commencez par créer votre première variété
                                    @endif
                                </p>
                            </div>
                            @if(request()->hasAny(['search', 'produit_id']))
                                <a href="{{ route('varietees.index') }}" class="btn btn-primary btn-sm mt-1">
                                    <i class="fas fa-times me-1 text-xs"></i>
                                    <span class="text-xs">Effacer les filtres</span>
                                </a>
                            @else
                                <a href="{{ route('varietees.create') }}" class="btn btn-success btn-sm mt-1">
                                    <i class="fas fa-plus me-1 text-xs"></i>
                                    <span class="text-xs">Créer une variété</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($varietees->hasPages())
                <div class="mt-4">
                    {{ $varietees->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            @endif

            <!-- Statistiques -->
            <div class="mt-6 pt-4 border-t border-base-200">
                <div class="stats stats-vertical lg:stats-horizontal shadow w-full text-xs sm:text-sm">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <i class="fas fa-leaf text-lg"></i>
                        </div>
                        <div class="stat-title text-xs">Total variétés</div>
                        <div class="stat-value text-primary text-lg">{{ $varietees->total() }}</div>
                        <div class="stat-desc text-xs">
                            @if(request('produit_id'))
                                Pour ce produit
                            @else
                                Tous produits
                            @endif
                        </div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <i class="fas fa-carrot text-lg"></i>
                        </div>
                        <div class="stat-title text-xs">Produits associés</div>
                        <div class="stat-value text-secondary text-lg">
                            {{ $varietees->pluck('produit_id')->unique()->count() }}
                        </div>
                        <div class="stat-desc text-xs">Produits différents</div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-accent">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <div class="stat-title text-xs">Dernière création</div>
                        <div class="stat-value text-accent text-sm">
                            @if($varietees->count() > 0)
                                {{ $varietees->first()->created_at->diffForHumans() }}
                            @else
                                --
                            @endif
                        </div>
                        <div class="stat-desc text-xs">Il y a</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .truncate-2-lines {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 2.5em;
        line-height: 1.25em;
    }

    /* Style pour les liens de tri */
    th a {
        color: inherit;
        text-decoration: none;
    }

    th a:hover {
        color: #3b82f6;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-soumission du formulaire de tri
        const sortSelects = document.querySelectorAll('select[name="sort"], select[name="direction"]');
        sortSelects.forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });

        // Effacer un filtre spécifique
        const clearFilterButtons = document.querySelectorAll('.badge a');
        clearFilterButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = this.href;
            });
        });

        // Focus sur la barre de recherche au chargement si vide
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput && !searchInput.value) {
            searchInput.focus();
        }
    });
</script>
@endpush
@endsection
