@extends('app')

@section('title', 'Modifier le produit')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2"></i> <span>Produits & Variétés</span></li>
    <li><a href="{{ route('produits.index') }}"><i class="fas fa-list me-2"></i> <span>Liste des produits</span></a></li>
    <li><i class="fas fa-edit me-2"></i> <span>Modifier {{ $produit->nom_produit }}</span></li>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- En-tête avec icône -->
    <div class="mb-8 flex items-center gap-4">
        <div class="avatar placeholder">
            <div class="bg-orange-100 text-orange-600 rounded-full w-12 h-12">
                <i class="fas fa-carrot text-xl"></i>
            </div>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Modifier le produit</h1>
            <p class="text-gray-600 mt-1">Mettez à jour les informations de {{ $produit->nom_produit }}</p>
        </div>
    </div>

    <!-- Carte du formulaire -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('produits.update', $produit) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nom du produit -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">
                            <i class="fas fa-tag me-2 text-orange-500"></i>
                            Nom du produit
                        </span>
                        <span class="label-text-alt text-error">* Requis</span>
                    </label>
                    <input type="text"
                           name="nom_produit"
                           value="{{ old('nom_produit', $produit->nom_produit) }}"
                           class="input input-bordered w-full @error('nom_produit') input-error @enderror"
                           placeholder="Ex: Tomate cerise, Pomme de terre..."
                           required>
                    @error('nom_produit')
                        <label class="label">
                            <span class="label-text-alt text-error">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">
                            <i class="fas fa-align-left me-2 text-green-500"></i>
                            Description
                        </span>
                        <span class="label-text-alt text-error">* Requis</span>
                    </label>
                    <textarea name="description_produit"
                              class="textarea textarea-bordered h-48 @error('description_produit') textarea-error @enderror"
                              placeholder="Décrivez le produit, ses caractéristiques, ses variétés..."
                              required>{{ old('description_produit', $produit->description_produit) }}</textarea>
                    @error('description_produit')
                        <label class="label">
                            <span class="label-text-alt text-error">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Métadonnées -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="bg-base-200 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-calendar-plus text-blue-500"></i>
                            <span class="font-medium">Créé le</span>
                        </div>
                        <div class="text-gray-700">{{ $produit->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                    <div class="bg-base-200 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-calendar-check text-green-500"></i>
                            <span class="font-medium">Dernière modification</span>
                        </div>
                        <div class="text-gray-700">{{ $produit->updated_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="form-control pt-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="btn btn-success flex-1 gap-2">
                            <i class="fas fa-save"></i>
                            Mettre à jour
                        </button>
                        <a href="{{ route('produits.show', $produit) }}" class="btn btn-info flex-1 gap-2">
                            <i class="fas fa-eye"></i>
                            Voir détails
                        </a>
                        <a href="{{ route('produits.index') }}" class="btn btn-ghost flex-1 gap-2">
                            <i class="fas fa-times"></i>
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Danger zone -->
    <div class="mt-8">
        <div class="card bg-error bg-opacity-10 border border-error border-opacity-30">
            <div class="card-body">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-exclamation-triangle text-error text-xl"></i>
                    <h3 class="font-bold text-error">Zone de danger</h3>
                </div>
                <p class="text-sm text-gray-700 mb-4">
                    La suppression est définitive. Toutes les données associées seront perdues.
                </p>
                <form action="{{ route('produits.destroy', $produit) }}"
                      method="POST"
                      onsubmit="return confirm('Êtes-vous vraiment sûr de vouloir supprimer ce produit ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-outline gap-2">
                        <i class="fas fa-trash"></i>
                        Supprimer ce produit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
