@extends('app')

@section('title', 'Produits')

@section('content')
    <div class=" space-y-8">
        <x-title-page class_icon="fas fa-carrot text-orange-500" title="Gestion des produits"
            sub_title="Administration du catalogue des produits agricoles"></x-title-page>

        <div class="flex gap-8 items-center">
            <form method="POST" action="{{ route('produits.store') }}"
                class="bg-base-100 shadow-sm rounded-sm w-fit h-fit flex items-end  p-4 gap-4">
                @csrf
                <input type="hidden" name="type" value="produit">
                <div class="w-full">
                    <label for="" class="block mb-1 text-[12px] font-semibold">Nom produit</label>
                    <input type="text" name="nom_produit" placeholder="Exp: Chou"
                        class="input input-bordered w-full outline-none" required>
                </div>
                <div class="w-full">
                    <label for="" class="block mb-1 text-[12px] font-semibold">Description</label>
                    <input type="text" name="description_produit"
                        placeholder="Exp: Produit avec divers varietee disponible"
                        class="input input-bordered w-full outline-none" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Ajouter un produit
                </button>
            </form>
            <div class="flex flex-col items-start bg-base-100 p-4 rounded-sm shadow-sm gap-4">
                <div class="flex items-center justify-center gap-4">
                    <p class="badge badge-soft badge-primary">Nombre de produits : </p>
                    <span class="badge badge-soft badge-primary">{{ $total_produits }}</span>
                </div>
                <div class="flex items-center justify-center gap-4">
                    <p class="badge badge-soft badge-accent">Nombre de varietees : </p>
                    <span class="badge badge-soft badge-accent">{{ $total_varietes }}</span>
                </div>
            </div>

        </div>

        <form method="GET" action="{{ route('produits.index') }}"
            class="flex items-end gap-4 bg-base-100 rounded-sm shadow-sm w-fit p-4">
            <!-- Champ de recherche -->
            <div>
                <label for="" class="block mb-1 text-[12px] font-bold">Nom produit ou variete</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Rechercher un produit ou une variété" class="input outline-none">
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i>
                Rechercher
            </button>
        </form>

        {{-- Message de succès --}}
        @if (session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Bloc titre --}}

        {{-- Tableau des produits --}}
        <div class="space-y-4">
            <table
                class="w-full table [&_tr]:border-0 [&_td]:border-0 [&_th]:border-0  border-separate border-spacing-y-3 bg-base-100 shadow-sm">

                <!-- En-tête -->
                <thead class="[&_tr]:font-bold [&_tr]:text-base-content">
                    <tr>
                        <th>Produit</th>
                        <th>Variétés</th>
                        <th>Créé le</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <!-- Corps du tableau -->
                <tbody class="[&_tr]:text-sm [&_tr]:hover:bg-base-content/10">
                    @forelse($produits as $produit)
                        <tr>
                            <td>
                                <span class="badge bg-green-300/30">{{ $produit->nom_produit }}</span>
                            </td>

                            <td>
                                <span class="badge badge-soft badge-error w-10">{{ $produit->varietees->count() }}</span>
                            </td>
                            <td>
                                <span class="badge badge-soft badge-base">
                                    {{ $produit->created_at->format('d/m/Y H:i') }}
                                </span>
                            </td>
                            <td>{{ $produit->description_produit }}</td>
                            <td>
                                <button
                                    onclick="document.getElementById('edit-produit-{{ $produit->id }}').classList.toggle('hidden')"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                    Modifier
                                </button>
                            </td>
                        </tr>
                        <tr id="edit-produit-{{ $produit->id }}" class="hidden bg-base-content/10">
                            <td colspan="5">
                                <form method="POST" action="{{ route('produits.update', $produit->id) }}"
                                    class="w-fit flex items-center gap-4">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="type" value="produit" class="input outline-none">

                                    <input type="text" name="nom_produit" value="{{ $produit->nom_produit }}"
                                        class="input outline-none" required>

                                    <input type="text" name="description_produit"
                                        value="{{ $produit->description_produit }}" class="input outline-none" required>

                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-floppy-disk"></i>
                                        Sauvegarder
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr id="varietees-{{ $produit->id }}" class="hidden bg-base-100">
                            <td colspan="6">

                                @if ($produit->varietees->count())
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                        @foreach ($produit->varietees as $varietee)
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
                            <td colspan="5" class="text-center text-neutral-content">
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
            document.querySelectorAll('[id^="varietees-"]').forEach(function(div) {
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
