@extends('app')

@section('title', 'Gestion des Produits')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><i class="fas fa-list me-2 text-sm"></i> <span class="text-sm">Liste des produits</span></li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-2 sm:px-4">
    <!-- En-tête avec bouton -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Gestion des Produits</h1>
            <p class="text-gray-600 text-sm mt-1">Gérez vos produits agricoles et leurs variétés</p>
        </div>
        <a href="{{ route('produits.create') }}" class="btn btn-success btn-sm sm:btn-md gap-1 sm:gap-2">
            <i class="fas fa-plus text-xs sm:text-sm"></i>
            <span class="text-xs sm:text-sm">Nouveau produit</span>
        </a>
    </div>

    <!-- Carte principale -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body p-3 sm:p-4">
            <!-- Tableau responsive -->
            <div class="overflow-x-auto -mx-2 sm:mx-0">
                <table class="table table-zebra table-sm sm:table-md">
                    <thead>
                        <tr class="bg-base-200">
                            <th class="font-semibold text-xs sm:text-sm py-2">ID</th>
                            <th class="font-semibold text-xs sm:text-sm py-2">Nom du produit</th>
                            <th class="font-semibold text-xs sm:text-sm py-2">Description</th>
                            <th class="font-semibold text-xs sm:text-sm py-2">Créé le</th>
                            <th class="font-semibold text-xs sm:text-sm py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produits as $produit)
                            <tr class="hover:bg-base-100 transition-colors">
                                <td class="text-xs sm:text-sm py-2">#{{ $produit->id }}</td>
                                <td class="py-2">
                                    <div class="flex items-center gap-2">
                                        <div class="avatar placeholder">
                                            <div class="bg-orange-100 text-orange-600 rounded-full w-6 h-6 sm:w-7 sm:h-7">
                                                <i class="fas fa-carrot text-xs"></i>
                                            </div>
                                        </div>
                                        <span class="font-medium text-xs sm:text-sm truncate max-w-[120px] sm:max-w-[200px]">{{ $produit->nom_produit }}</span>
                                    </div>
                                </td>
                                <td class="py-2">
                                    <div class="max-w-[150px] sm:max-w-xs">
                                        <span class="truncate-2-lines text-xs sm:text-sm">{{ $produit->description_produit }}</span>
                                    </div>
                                </td>
                                <td class="py-2">
                                    <div class="text-xs">
                                        <div class="font-medium">{{ $produit->created_at->format('d/m/Y') }}</div>
                                        <div class="text-gray-500">{{ $produit->created_at->format('H:i') }}</div>
                                    </div>
                                </td>
                                <td class="py-2">
                                    <div class="flex gap-1 justify-center">
                                        <a href="{{ route('produits.show', $produit) }}"
                                           class="btn btn-info btn-xs sm:btn-sm gap-1"
                                           title="Voir détails">
                                            <i class="fas fa-eye text-xs"></i>
                                            <span class="hidden xs:inline text-xs">Voir</span>
                                        </a>
                                        <a href="{{ route('produits.edit', $produit) }}"
                                           class="btn btn-warning btn-xs sm:btn-sm gap-1"
                                           title="Modifier">
                                            <i class="fas fa-edit text-xs"></i>
                                            <span class="hidden xs:inline text-xs">Éditer</span>
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
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
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-base-200 text-base-400 rounded-full w-12 h-12">
                                                <i class="fas fa-carrot text-lg"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-semibold text-gray-700">Aucun produit trouvé</h3>
                                            <p class="text-gray-500 text-xs mt-1">Commencez par créer votre premier produit</p>
                                        </div>
                                        <a href="{{ route('produits.create') }}" class="btn btn-success btn-sm mt-1">
                                            <i class="fas fa-plus me-1 text-xs"></i>
                                            <span class="text-xs">Créer un produit</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($produits->hasPages())
                <div class="mt-4">
                    {{ $produits->links('vendor.pagination.tailwind') }}
                </div>
            @endif

            <!-- Statistiques -->
            <div class="mt-6 pt-4 border-t border-base-200">
                <div class="stats stats-vertical lg:stats-horizontal shadow w-full text-xs sm:text-sm">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <i class="fas fa-carrot text-lg sm:text-xl"></i>
                        </div>
                        <div class="stat-title text-xs">Total produits</div>
                        <div class="stat-value text-primary text-lg sm:text-xl">{{ $produits->total() }}</div>
                        <div class="stat-desc text-xs">Produits agricoles</div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <i class="fas fa-clock text-lg sm:text-xl"></i>
                        </div>
                        <div class="stat-title text-xs">Dernière création</div>
                        <div class="stat-value text-secondary text-sm">
                            @if($produits->count() > 0)
                                {{ $produits->first()->created_at->diffForHumans() }}
                            @else
                                --
                            @endif
                        </div>
                        <div class="stat-desc text-xs">Il y a</div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-accent">
                            <i class="fas fa-layer-group text-lg sm:text-xl"></i>
                        </div>
                        <div class="stat-title text-xs">Pages</div>
                        <div class="stat-value text-accent text-lg sm:text-xl">{{ $produits->lastPage() }}</div>
                        <div class="stat-desc text-xs">Navigation</div>
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

    /* Style personnalisé pour la pagination */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin: 0 2px;
    }

    .pagination .page-link {
        padding: 4px 8px;
        font-size: 0.75rem;
        border-radius: 4px;
    }
</style>
@endsection
