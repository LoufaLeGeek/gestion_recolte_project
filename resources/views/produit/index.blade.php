@extends('app')

@section('title', 'Produits')

@section('content')

<!-- Conteneur principal centré -->
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Bloc titre --}}
    <div class="mb-8 text-center">

        <h1 class="tracking-wider">Gestion des Produits</h1>
        <p class="text-neutral-content">
            Liste des produits agricoles et aperçu de leurs variétés
        </p>
    </div>

    {{-- Zone recherche et statistiques --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">

        <!-- Formulaire de recherche -->
        <form method="GET"
            action="{{ route('produits.index') }}"
            class="flex gap-3 w-full md:w-auto">

            <!-- Champ de recherche -->
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Rechercher un produit ou une variété"
                class="input input-bordered w-full md:w-64">

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-info">
                Rechercher
            </button>
        </form>

        <!-- Bloc statistiques -->
        <div class="stats shadow">

            <!-- Statistique produits -->
            <div class="stat">
                <div class="stat-title">Produits</div>
                <div class="stat-value">{{ $total_produits }}</div>
            </div>

            <!-- Statistique variétés -->
            <div class="stat">
                <div class="stat-title">Variétés</div>
                <div class="stat-value">{{ $total_varietes }}</div>
            </div>
        </div>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success shadow-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulaire d'ajout de produit --}}
    <div class="card bg-base-100 shadow-md mb-10">
        <div class="card-body">

            <!-- Formulaire -->
            <form method="POST"
                action="{{ route('produits.store') }}"
                class="flex flex-col md:flex-row gap-3 items-center">

                {{-- Protection CSRF --}}
                @csrf

                {{-- Type de formulaire --}}
                <input type="hidden" name="type" value="produit">

                <!-- Nom du produit -->
                <input type="text"
                    name="nom_produit"
                    placeholder="Nom du produit"
                    class="input input-bordered flex-1"
                    required>

                <!-- Description du produit -->
                <input type="text"
                    name="description_produit"
                    placeholder="Description"
                    class="input input-bordered flex-1"
                    required>

                <!-- Bouton ajouter -->
                <button type="submit" class="btn btn-primary">
                    Ajouter
                </button>
            </form>
        </div>
    </div>

    {{-- Tableau des produits --}}
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">

            <!-- En-tête -->
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Variétés</th>
                    <th>Créé le</th>
                    <th>Modifié le</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <!-- Corps du tableau -->
            <tbody>

                {{-- Boucle sur les produits --}}
                @forelse($produits as $produit)

                    <!-- Ligne produit -->
                    <tr>
                        <td>{{ $produit->nom_produit }}</td>
                        <td>{{ $produit->description_produit }}</td>

                        <!-- Bouton affichage variétés -->
                        <td>
                            <button onclick="toggleVarietees({{ $produit->id }})"
                                    class="badge badge-info">
                                {{ $produit->varietees->count() }} variétés
                            </button>
                        </td>

                        <!-- Dates -->
                        <td>{{ $produit->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $produit->updated_at->format('d/m/Y H:i') }}</td>

                        <!-- Actions -->
                        <td>
                            <button onclick="document.getElementById('edit-produit-{{ $produit->id }}').classList.toggle('hidden')"
                                    class="btn btn-sm btn-warning">
                                Modifier
                            </button>
                        </td>
                    </tr>

                    {{-- Formulaire de modification --}}
                    <tr id="edit-produit-{{ $produit->id }}"
                        class="hidden bg-base-200">
                        <td colspan="6">

                            <!-- Formulaire modification -->
                            <form method="POST"
                                action="{{ route('produits.update', $produit->id) }}"
                                class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="type" value="produit">

                                <input type="text"
                                    name="nom_produit"
                                    value="{{ $produit->nom_produit }}"
                                    class="input input-bordered w-full"
                                    required>

                                <input type="text"
                                    name="description_produit"
                                    value="{{ $produit->description_produit }}"
                                    class="input input-bordered w-full"
                                    required>

                                <button class="btn btn-primary w-full">
                                    Sauvegarder
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Liste des variétés --}}
                    <tr id="varietees-{{ $produit->id }}"
                        class="hidden bg-base-100">
                        <td colspan="6">

                            @if($produit->varietees->count())

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    @foreach($produit->varietees as $varietee)

                                        <div class="card bg-base-200 p-4">
                                            <p class="font-semibold">
                                                {{ $varietee->nom_varietee }}
                                            </p>
                                            <p class="text-sm text-neutral-content">
                                                {{ $varietee->caracteristique_varietee }}
                                            </p>
                                            <p class="text-xs text-neutral-content mt-2">
                                                Créé le : {{ $varietee->created_at->format('d/m/Y H:i') }}<br>
                                                Modifié le : {{ $varietee->updated_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>

                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-neutral-content">
                                    Aucune variété enregistrée.
                                </p>
                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6"
                            class="text-center text-neutral-content">
                            Aucun produit enregistré.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $produits->links() }}
    </div>
</div>

{{-- Script JavaScript --}}
<script>
    // Fonction d'affichage unique des variétés
    function toggleVarietees(id) {

        // Masquer toutes les listes
        document.querySelectorAll('[id^="varietees-"]').forEach(function (div) {
            if (div.id !== 'varietees-' + id) {
                div.classList.add('hidden');
            }
        });

        // Afficher ou masquer la liste sélectionnée
        document.getElementById('varietees-' + id).classList.toggle('hidden');
    }
</script>

{{-- Fin de la section contenu --}}
@endsection
