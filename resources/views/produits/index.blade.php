@extends('app')

@section('title', 'Gestion des Produits')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2"></i> <span>Produits & Variétés</span></li>
    <li><i class="fas fa-list me-2"></i> <span>Liste des produits</span></li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- En-tête avec bouton -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestion des Produits</h1>
            <p class="text-gray-600 mt-2">Gérez vos produits agricoles et leurs variétés</p>
        </div>
        <a href="{{ route('produits.create') }}" class="btn btn-success gap-2">
            <i class="fas fa-plus"></i>
            Nouveau produit
        </a>
    </div>

    <!-- Carte principale -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <!-- Tableau responsive -->
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr class="bg-base-200">
                            <th class="font-bold">ID</th>
                            <th class="font-bold">Nom du produit</th>
                            <th class="font-bold">Description</th>
                            <th class="font-bold">Date de création</th>
                            <th class="font-bold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produits as $produit)
                            <tr class="hover:bg-base-100 transition-colors">
                                <td class="font-semibold">#{{ $produit->id }}</td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-orange-100 text-orange-600 rounded-full w-8 h-8">
                                                <i class="fas fa-carrot"></i>
                                            </div>
                                        </div>
                                        <span class="font-medium">{{ $produit->nom_produit }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="max-w-xs">
                                        <span class="truncate-2-lines">{{ $produit->description_produit }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="font-medium">{{ $produit->created_at }}</div>
                                        <div class="text-gray-500">{{ $produit->created_at}}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex gap-2 justify-center text-[8px]">
                                        <a href="{{ route('produits.show', $produit) }}"
                                           class="btn btn-info btn-sm gap-1"
                                           title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                            <span class="hidden sm:inline">Voir</span>
                                        </a>
                                        <a href="{{ route('produits.edit', $produit) }}"
                                           class="btn btn-warning btn-sm gap-1"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                            <span class="hidden sm:inline">Éditer</span>
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-error btn-sm gap-1"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                                <span class="hidden sm:inline">Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8">
                                    <div class="flex flex-col items-center justify-center gap-4">
                                        <div class="avatar placeholder">
                                            <div class="bg-base-200 text-base-400 rounded-full w-16 h-16">
                                                <i class="fas fa-carrot text-2xl"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-700">Aucun produit trouvé</h3>
                                            <p class="text-gray-500 mt-1">Commencez par créer votre premier produit</p>
                                        </div>
                                        <a href="{{ route('produits.create') }}" class="btn btn-success mt-2">
                                            <i class="fas fa-plus me-2"></i>
                                            Créer un produit
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
                <div class="mt-8">
                    {{ $produits->links() }}
                </div>
            @endif

            <!-- Statistiques -->
            <div class="mt-8 pt-6 border-t border-base-200">
                <div class="stats stats-vertical lg:stats-horizontal shadow w-full">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <i class="fas fa-carrot text-2xl"></i>
                        </div>
                        <div class="stat-title">Total produits</div>
                        <div class="stat-value text-primary">{{ $produits->total() }}</div>
                        <div class="stat-desc">Produits agricoles</div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="stat-title">Dernière création</div>
                        <div class="stat-value text-secondary">
                            @if($produits->count() > 0)
                                {{ $produits->first()->created_at->diffForHumans() }}
                            @else
                                --
                            @endif
                        </div>
                        <div class="stat-desc">Il y a</div>
                    </div>

                    <div class="stat">
                        <div class="stat-figure text-accent">
                            <i class="fas fa-layer-group text-2xl"></i>
                        </div>
                        <div class="stat-title">Pages</div>
                        <div class="stat-value text-accent">{{ $produits->lastPage() }}</div>
                        <div class="stat-desc">Navigation</div>
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
        max-height: 3em;
    }
</style>
@endsection
