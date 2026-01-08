@extends('app')
@section('title', 'Gestion des Variétés')
@section('content')
    <div class="space-y-4">
        <!-- Messages de session -->
        <div id="flash-messages" class="space-y-3">
            @if (session()->has('success'))
                <div class="alert alert-success shadow-lg transition-all duration-300" data-auto-dismiss="5000">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-lg shrink-0"></i>
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
                        <i class="fas fa-exclamation-circle text-lg shrink-0"></i>
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
        <div class="flex justify-between items-center">
            <x-title-page class_icon="fas fa-leaf text-green-500" title="Gestion des variétés"
                sub_title="Organisation et suivi des variétés par produit"></x-title-page>
            <a href="{{ route('varietees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span class="">Nouvelle variété</span>
            </a>
        </div>

        <!-- Recherche et filtres simplifiés -->
        <div class="bg-base-100 shadow-sm p-4 space-y-4 w-fit rounded-sm">
            <!-- Formulaire de recherche -->
            <div class="">
                <form method="GET" action="{{ route('varietees.index') }}" class="flex items-end gap-4">
                    <!-- Barre de recherche principale -->
                    <div class="flex items-end gap-4">
                        <div class="">
                            <label for="" class="text-[12px] font-bold block mb-1">Nom varietee</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="input outline-none"
                                placeholder="Rechercher une variété...">
                        </div>

                        <div>
                            <label for="" class="text-[12px] font-bold block mb-1">Selectionner un produit</label>
                            <select name="produit_id" class="select outline-none w-64">
                                <option value="">Tous les produits</option>
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->id }}"
                                        {{ request('produit_id') == $produit->id ? 'selected' : '' }}>
                                        {{ $produit->nom_produit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Options de tri -->
                    <div class="flex items-end gap-4">
                        <div>
                            <label for="" class="text-[12px] font-bold block mb-1">Option de trie</label>
                            <select name="sort" class="select outline-none w-40">
                                <option value="created_at"
                                    {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>
                                    Date
                                </option>
                                <option value="nom_varietee" {{ request('sort') == 'nom_varietee' ? 'selected' : '' }}>
                                    Nom
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="" class="text-[12px] font-bold block mb-1">Croissant , decroissant</label>
                            <select name="direction" class="select outline-none w-40">
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>
                                    ↓ Décroissant
                                </option>
                                <option value="asc" {{ request('direction', 'asc') == 'asc' ? 'selected' : '' }}>
                                    ↑ Croissant
                                </option>
                            </select>
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter text-xs"></i>
                                Appliquer
                            </button>

                            @if (request()->hasAny(['search', 'produit_id', 'sort', 'direction']))
                                <a href="{{ route('varietees.index') }}" class="btn btn-shoft btn-error btn-sm">
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
                <x-varietee.card-stat-variete type="Variétés" :value="$varietees->total()" icone="fas fa-leaf" />

                <x-varietee.card-stat-variete type="Produits" :value="$varietees->pluck('produit_id')->unique()->count()" description="Différents"
                    icone="fas fa-carrot" color="orange" />

                <!-- Gamme de prix (optionnel) -->
                @if ($varietees->count() > 0)
                    @php
                        $varieteesAvecPrix = $varietees->filter(fn($v) => $v->prix_actuelle);
                        $prixMin = $varieteesAvecPrix->min('prix_actuelle.prix');
                        $prixMax = $varieteesAvecPrix->max('prix_actuelle.prix');
                        $prixMoyen = $varieteesAvecPrix->avg('prix_actuelle.prix');
                    @endphp

                    @if ($prixMin && $prixMax)
                        <div class="mt-3 pt-3 border-t border-base-200 col-span-2">
                            <div class="text-xs font-semibold text-gray-600 mb-2">Gamme de prix :</div>
                            <div class="flex items-center justify-between text-sm">
                                <!-- Prix Min -->
                                <x-varietee.variete-gamme-prix prixType="Min" color="green" :prix="$prixMin" />

                                <!-- Prix Moyen -->
                                <x-varietee.variete-gamme-prix prixType="Moyen" color="blue" :prix="$prixMoyen" />

                                <!-- Prix Max -->
                                <x-varietee.variete-gamme-prix prixType="Max" color="red" :prix="$prixMax" />
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
                                <x-varietee.varietee-tuile :varietee="$varietee" />
                            @empty
                                <tr>
                                    <x-varietee.varietee-empty-tuile />
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

    @push('scripts')
        <script src="resources/js/varietee/auto-dismiss-message.js"></script>
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
