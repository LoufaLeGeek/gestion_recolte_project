@extends('app')

@section('title', 'Produits & Variétés')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- TITRE --}}
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-800 dark:text-slate-100">
            Produits et Variétés
        </h1>
        <p class="mt-2 text-slate-600 dark:text-slate-400">
            Gestion des produits agricoles et de leurs variétés
        </p>
    </div>

    {{-- MESSAGE SUCCESS --}}
    @if(session('success'))
        <div class="mb-6 rounded-md border border-green-300 bg-green-50 px-4 py-3 text-green-700 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- AJOUT PRODUIT --}}
    <div class="mb-10 rounded-lg border bg-white dark:bg-slate-900 p-6 shadow-sm">
        <h2 class="text-xl font-semibold mb-4">Ajouter un produit</h2>

        <form method="POST" action="{{ route('produit-varietee.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="type" value="produit">

            <input type="text" name="nom_produit" placeholder="Nom du produit"
                   class="w-full rounded-md border px-4 py-2" required>

            <textarea name="description_produit" placeholder="Description du produit"
                      class="w-full rounded-md border px-4 py-2" required></textarea>

            <button type="submit" class="rounded-md bg-blue-600 px-6 py-2 text-white hover:bg-blue-700 transition">
                Ajouter
            </button>
        </form>
    </div>

    {{-- LISTE PRODUITS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($produits as $produit)
            <div class="rounded-lg border bg-white dark:bg-slate-900 p-6 shadow-sm">

                {{-- PRODUIT --}}
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $produit->nom_produit }}</h3>
                        <p class="text-sm text-slate-600">{{ $produit->description_produit }}</p>
                    </div>

                    <div class="flex items-center space-x-2">
                        {{-- Bouton Modifier inline --}}
                        <button type="button"
                                onclick="document.getElementById('edit-produit-{{ $produit->id }}').classList.toggle('hidden')"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                            Modifier
                        </button>

                        {{-- Bouton Supprimer --}}
                        <form method="POST" action="{{ route('produit-varietee.destroy', $produit->id) }}">
                            @csrf @method('DELETE')
                            <input type="hidden" name="type" value="produit">
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                {{-- FORMULAIRE MODIFIER PRODUIT (inline) --}}
                <div id="edit-produit-{{ $produit->id }}" class="hidden mb-4">
                    <form method="POST" action="{{ route('produit-varietee.update', $produit->id) }}" class="space-y-3">
                        @csrf @method('PUT')
                        <input type="hidden" name="type" value="produit">

                        <input type="text" name="nom_produit" value="{{ $produit->nom_produit }}"
                               class="w-full rounded-md border px-3 py-2" required>

                        <textarea name="description_produit" class="w-full rounded-md border px-3 py-2" required>{{ $produit->description_produit }}</textarea>

                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Sauvegarder
                        </button>
                    </form>
                </div>

                {{-- VARIÉTÉS --}}
                <h4 class="font-medium mb-2">Variétés</h4>
                @if($produit->varietees->count())
                    <ul class="space-y-2">
                        @foreach($produit->varietees as $varietee)
                            <li class="rounded border bg-slate-50 dark:bg-slate-800 px-3 py-2">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium">{{ $varietee->nom_varietee }}</p>
                                        <p class="text-xs text-slate-500">{{ $varietee->caracteristique_varietee }}</p>
                                    </div>

                                    <div class="flex space-x-1">
                                        <button type="button"
                                                onclick="document.getElementById('edit-varietee-{{ $varietee->id }}').classList.toggle('hidden')"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">
                                            Modifier
                                        </button>

                                        <form method="POST" action="{{ route('produit-varietee.destroy', $varietee->id) }}">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="type" value="varietee">
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                {{-- FORMULAIRE MODIFIER VARIÉTÉ (inline) --}}
                                <div id="edit-varietee-{{ $varietee->id }}" class="hidden mt-2">
                                    <form method="POST" action="{{ route('produit-varietee.update', $varietee->id) }}" class="space-y-2">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="type" value="varietee">

                                        <input type="text" name="nom_varietee" value="{{ $varietee->nom_varietee }}"
                                               class="w-full rounded-md border px-3 py-2 text-sm" required>

                                        <input type="text" name="caracteristique_varietee" value="{{ $varietee->caracteristique_varietee }}"
                                               class="w-full rounded-md border px-3 py-2 text-sm">

                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                            Sauvegarder
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-slate-500">Aucune variété enregistrée.</p>
                @endif

                {{-- AJOUT VARIÉTÉ --}}
                <form method="POST" action="{{ route('produit-varietee.store') }}" class="border-t pt-4 space-y-3">
                    @csrf
                    <input type="hidden" name="type" value="varietee">
                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">

                    <input type="text" name="nom_varietee" placeholder="Nom de la variété"
                           class="w-full rounded-md border px-3 py-2 text-sm" required>

                    <input type="text" name="caracteristique_varietee" placeholder="Caractéristique"
                           class="w-full rounded-md border px-3 py-2 text-sm">

                    <button class="w-full rounded-md bg-slate-800 text-white py-2 hover:bg-slate-900 transition">
                        Ajouter variété
                    </button>
                </form>
            </div>
        @empty
            <p class="col-span-full text-center text-slate-500">Aucun produit enregistré.</p>
        @endforelse
    </div>
</div>
@endsection
