@extends('app')

@section('title', 'Gestion des Variétés')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><i class="fas fa-leaf me-2 text-sm"></i> <span class="text-sm">Liste des variétés</span></li>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-2 sm:px-4">
        <!-- Messages de session -->
        <div id="flash-messages" class="mb-6 space-y-3">
            @if (session()->has('success'))
                <div class="alert alert-success shadow-lg transition-all duration-300" data-auto-dismiss="5000">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-lg flex-shrink-0"></i>
                        <div class="flex-1">
                            <span class="font-medium">Succès :</span>
                            <span class="text-sm ml-1">{{ session('success') }}</span>
                        </div>
                        <button class="btn btn-xs btn-circle btn-ghost" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="progress-bar h-1 bg-green-400 mt-2 rounded-full origin-left"
                        style="animation: progress 5s linear;"></div>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-error shadow-lg transition-all duration-300" data-auto-dismiss="5000">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-lg flex-shrink-0"></i>
                        <div class="flex-1">
                            <span class="font-medium">Erreur :</span>
                            <span class="text-sm ml-1">{{ session('error') }}</span>
                        </div>
                        <button class="btn btn-xs btn-circle btn-ghost" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="progress-bar h-1 bg-red-400 mt-2 rounded-full origin-left"
                        style="animation: progress 5s linear;"></div>
                </div>
            @endif
        </div>
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

        <!-- Recherche et filtres simplifiés -->
        <div class="card bg-base-100 shadow-md mb-6 p-3 sm:p-4">
            <!-- Formulaire de recherche -->
            <div class="mb-4">
                <form method="GET" action="{{ route('varietees.index') }}" class="space-y-3">
                    <!-- Barre de recherche principale -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search text-sm"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="input input-bordered input-sm w-full pl-10" placeholder="Rechercher une variété...">
                        </div>

                        <select name="produit_id" class="select select-bordered select-sm w-full sm:w-auto">
                            <option value="">Tous les produits</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}"
                                    {{ request('produit_id') == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->nom_produit }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Options de tri -->
                    <div class="flex flex-wrap gap-2 items-center text-sm">
                        <span class="text-gray-600">Trier par :</span>
                        <select name="sort" class="select select-bordered select-xs">
                            <option value="created_at"
                                {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>
                                Date
                            </option>
                            <option value="nom_varietee" {{ request('sort') == 'nom_varietee' ? 'selected' : '' }}>
                                Nom
                            </option>
                        </select>

                        <select name="direction" class="select select-bordered select-xs">
                            <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>
                                ↓ Décroissant
                            </option>
                            <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>
                                ↑ Croissant
                            </option>
                        </select>

                        <!-- Boutons -->
                        <div class="ml-auto flex gap-2">
                            <button type="submit" class="btn btn-primary btn-xs">
                                <i class="fas fa-filter text-xs"></i>
                                Appliquer
                            </button>

                            @if (request()->hasAny(['search', 'produit_id', 'sort', 'direction']))
                                <a href="{{ route('varietees.index') }}" class="btn btn-ghost btn-xs">
                                    <i class="fas fa-times text-xs"></i>
                                    Effacer
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-3">
                <div class="stat bg-base-200 rounded-lg p-3">
                    <div class="flex items-center gap-2 mb-1">
                        <div>
                            <div class="stat-title text-xs">Variétés</div>
                            <div class="stat-value text-lg">{{ $varietees->total() }}</div>
                        </div>
                    </div>
                    <div class="stat-desc text-xs">
                        @if (request('produit_id'))
                            Pour ce produit
                        @else
                            Total
                        @endif
                    </div>
                    <div class="stat-figure text-primary">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>

                {{-- <div class="stat bg-base-200 rounded-lg p-3">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="stat-figure text-green-500">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <div class="stat-title text-xs">Prix moyen</div>
                            <div class="stat-value text-lg">
                                @php
                                    $prixMoyen = $varietees
                                        ->filter(fn($v) => $v->prix_actuelle)
                                        ->avg('prix_actuelle.prix');
                                @endphp
                                @if ($prixMoyen)
                                    {{ number_format($prixMoyen, 0, '', ' ') }}
                                @else
                                    --
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="stat-desc text-xs">FCFA</div>
                </div> --}}

                <div class="stat bg-base-200 rounded-lg p-3">
                    <div class="flex items-center gap-2 mb-1">

                        <div>
                            <div class="stat-title text-xs">Produits</div>
                            <div class="stat-value text-lg">
                                {{ $varietees->pluck('produit_id')->unique()->count() }}
                            </div>
                        </div>
                    </div>
                    <div class="stat-desc text-xs">Différents</div>
                    <div class="stat-figure text-orange-500">
                        <i class="fas fa-carrot"></i>
                    </div>
                </div>


                <!-- Gamme de prix (optionnel) -->
                @if ($varietees->count() > 0)
                    @php
                        $varieteesAvecPrix = $varietees->filter(fn($v) => $v->prix_actuelle);
                        $prixMin = $varieteesAvecPrix->min('prix_actuelle.prix');
                        $prixMax = $varieteesAvecPrix->max('prix_actuelle.prix');
                    @endphp

                    @if ($prixMin && $prixMax)
                        <div class="mt-3 pt-3 border-t border-base-200 col-span-2">
                            <div class="text-xs font-semibold text-gray-600 mb-2">Gamme de prix :</div>
                            <div class="flex items-center justify-between text-sm">
                                <div class="text-green-600 font-medium">
                                    <i class="fas fa-arrow-down text-xs mr-1"></i>
                                    Min : {{ number_format($prixMin, 0, '', ' ') }} FCFA
                                </div>
                                <div class="text-blue-600 font-medium">
                                    <i class="fas fa-chart-line text-xs mr-1"></i>
                                    Moy :
                                    @php
                                        $prixMoyen = $varieteesAvecPrix->avg('prix_actuelle.prix');
                                    @endphp
                                    {{ $prixMoyen ? number_format($prixMoyen, 0, '', ' ') . ' FCFA' : '--' }}
                                </div>
                                <div class="text-red-600 font-medium">
                                    <i class="fas fa-arrow-up text-xs mr-1"></i>
                                    Max : {{ number_format($prixMax, 0, '', ' ') }} FCFA
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
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
                                <th class="font-semibold text-xs sm:text-sm py-2">Variété</th>
                                <th class="font-semibold text-xs sm:text-sm py-2">Produit</th>
                                <th class="font-semibold text-xs sm:text-sm py-2">Prix actuel</th>
                                <th class="font-semibold text-xs sm:text-sm py-2">Caractéristiques</th>
                                <th class="font-semibold text-xs sm:text-sm py-2">Créé le</th>
                                <th class="font-semibold text-xs sm:text-sm py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($varietees as $varietee)
                                <tr class="hover:bg-base-100 transition-colors">
                                    <td class="text-xs sm:text-sm py-2">#{{ $varietee->id }}</td>
                                    <td class="py-2">
                                        <div class="flex items-center gap-2">
                                            <div class="avatar placeholder">
                                                <div
                                                    class="flex items-center justify-center bg-green-100 text-green-600 rounded-full w-6 h-6">
                                                    <i class="fas fa-leaf text-xs"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span
                                                    class="font-medium text-xs sm:text-sm">{{ $varietee->nom_varietee }}</span>
                                                @if ($varietee->prix_actuel)
                                                    <div class="text-green-600 text-xs font-semibold">
                                                        <i class="fas fa-money-bill-wave text-xs"></i>
                                                        {{ $varietee->prix_formate }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <div class="flex items-center gap-2">
                                            <div class="avatar placeholder">
                                                <div
                                                    class="flex items-center justify-center bg-orange-100 text-orange-600 rounded-full w-6 h-6">
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
                                        <div class="text-center">
                                            @if ($varietee->prix_actuelle)
                                                <div class="inline-flex flex-col items-center">
                                                    <span class="font-bold text-green-700 text-sm">
                                                        {{ number_format($varietee->prix_actuelle->prix, 0, ',', ' ') }}
                                                    </span>
                                                    <span class="text-xs text-gray-500">FCFA</span>
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <i class="fas fa-calendar-day text-xs"></i>
                                                    Depuis
                                                    {{ \Carbon\Carbon::parse($varietee->prix_actuelle->date_debut ?? now())->format('D-M-Y') }}
                                                </div>
                                            @else
                                                <span class="badge badge-warning badge-sm gap-1">
                                                    <i class="fas fa-exclamation-triangle text-xs"></i>
                                                    Aucun prix
                                                </span>
                                                <a href="{{ route('varietees.edit', $varietee) }}"
                                                    class="text-xs text-blue-600 hover:text-blue-800 mt-1 block">
                                                    Définir un prix
                                                </a>
                                            @endif
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
                                                class="btn btn-info btn-xs sm:btn-sm gap-1" title="Voir détails">
                                                <i class="fas fa-eye text-xs"></i>
                                                <span class="hidden xs:inline text-xs">Voir</span>
                                            </a>
                                            <a href="{{ route('varietees.edit', $varietee) }}"
                                                class="btn btn-warning btn-xs sm:btn-sm gap-1" title="Modifier">
                                                <i class="fas fa-edit text-xs"></i>
                                                <span class="hidden xs:inline text-xs">Éditer</span>
                                            </a>
                                            <form action="{{ route('varietees.destroy', $varietee) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette variété ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-error btn-xs sm:btn-sm gap-1"
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
                                    <td colspan="7" class="text-center py-6">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-base-200 text-base-400 rounded-full w-12 h-12">
                                                    <i class="fas fa-leaf text-lg"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-semibold text-gray-700">Aucune variété trouvée</h3>
                                                <p class="text-gray-500 text-xs mt-1">Commencez par créer votre première
                                                    variété</p>
                                            </div>
                                            <a href="{{ route('varietees.create') }}"
                                                class="btn btn-success btn-sm mt-1">
                                                <i class="fas fa-plus me-1 text-xs"></i>
                                                <span class="text-xs">Créer une variété</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($varietees->hasPages())
                    <div class="mt-4">
                        {{ $varietees->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        .truncate-2-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: auto;
            max-height: 2.5em;
            line-height: 1.25em;
        }
    </style>
    @push('scripts')
        <script>
            // Auto-dismiss des messages après 5 secondes
            document.addEventListener('DOMContentLoaded', function() {
                const messages = document.querySelectorAll('[data-auto-dismiss]');

                messages.forEach(message => {
                    const duration = parseInt(message.getAttribute('data-auto-dismiss'));

                    setTimeout(() => {
                        message.style.opacity = '0';
                        message.style.transform = 'translateY(-10px)';
                        setTimeout(() => message.remove(), 300);
                    }, duration);
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            @keyframes progress {
                from {
                    transform: scaleX(1);
                }

                to {
                    transform: scaleX(0);
                }
            }

            .alert {
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush
@endsection
