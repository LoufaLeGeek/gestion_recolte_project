@extends('app')

@section('title', 'Modifier le produit')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><a href="{{ route('produits.index') }}"><i class="fas fa-list me-2 text-sm"></i> <span class="text-sm">Liste des produits</span></a></li>
    <li><i class="fas fa-edit me-2 text-sm"></i> <span class="text-sm">Modifier {{ $produit->nom_produit }}</span></li>
@endsection

@section('content')
<div class="max-w-3xl mx-auto px-2 sm:px-4">
    <!-- En-tête avec icône -->
    <div class="mb-6 flex items-center gap-3">
        <div class="avatar placeholder">
            <div class="flex items-center justify-center bg-orange-100 text-orange-600 rounded-full w-10 h-10">
                <i class="fas fa-carrot text-base"></i>
            </div>
        </div>
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Modifier le produit</h1>
            <p class="text-gray-600 text-sm mt-1">Mettez à jour les informations de {{ $produit->nom_produit }}</p>
        </div>
    </div>

    <!-- Carte du formulaire -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body p-3 sm:p-4">
            <form action="{{ route('produits.update', $produit) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nom du produit -->
                <div class="form-control">
                    <label class="label py-1">
                        <span class="label-text font-semibold text-sm">
                            <i class="fas fa-tag me-2 text-orange-500 text-xs"></i>
                            Nom du produit
                        </span>
                        <span class="label-text-alt text-error text-xs">* Requis</span>
                    </label>
                    <input type="text"
                           name="nom_produit"
                           value="{{ old('nom_produit', $produit->nom_produit) }}"
                           class="input input-bordered input-sm sm:input-md w-full @error('nom_produit') input-error @enderror"
                           placeholder="Ex: Tomate cerise, Pomme de terre..."
                           required>
                    @error('nom_produit')
                        <label class="label py-1">
                            <span class="label-text-alt text-error text-xs">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-control">
                    <label class="label py-1">
                        <span class="label-text font-semibold text-sm">
                            <i class="fas fa-align-left me-2 text-green-500 text-xs"></i>
                            Description
                        </span>
                        <span class="label-text-alt text-error text-xs">* Requis</span>
                    </label>
                    <textarea name="description_produit"
                    style="resize: none"
                              class="textarea textarea-bordered textarea-sm sm:textarea-md h-32 sm:h-40 @error('description_produit') textarea-error @enderror"
                              placeholder="Décrivez le produit, ses caractéristiques, ses variétés..."
                              required>{{ old('description_produit', $produit->description_produit) }}</textarea>
                    @error('description_produit')
                        <label class="label py-1">
                            <span class="label-text-alt text-error text-xs">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Métadonnées -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                    <div class="bg-base-200 rounded p-3">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-calendar-plus text-blue-500 text-xs"></i>
                            <span class="font-medium">Créé le</span>
                        </div>
                        <div class="text-gray-700">{{ $produit->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                    <div class="bg-base-200 rounded p-3">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-calendar-check text-green-500 text-xs"></i>
                            <span class="font-medium">Dernière modification</span>
                        </div>
                        <div class="text-gray-700">{{ $produit->updated_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="form-control pt-4">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <button type="submit" class="btn btn-success btn-sm sm:btn-md flex-1 gap-1">
                            <i class="fas fa-save text-xs sm:text-sm"></i>
                            <span class="text-xs sm:text-sm">Mettre à jour</span>
                        </button>
                        <a href="{{ route('produits.show', $produit) }}" class="btn btn-info btn-sm sm:btn-md flex-1 gap-1">
                            <i class="fas fa-eye text-xs sm:text-sm"></i>
                            <span class="text-xs sm:text-sm">Voir détails</span>
                        </a>
                        <a href="{{ route('produits.index') }}" class="btn btn-ghost btn-sm sm:btn-md flex-1 gap-1">
                            <i class="fas fa-times text-xs sm:text-sm"></i>
                            <span class="text-xs sm:text-sm">Annuler</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Danger zone -->
    <div class="mt-6">
        <div class="card bg-error bg-opacity-10 border border-error border-opacity-30">
            <div class="card-body p-3 sm:p-4">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fas fa-exclamation-triangle text-error text-base"></i>
                    <h3 class="font-bold text-error text-sm">Zone de danger</h3>
                </div>
                <p class="text-xs text-gray-700 mb-3">
                    La suppression est définitive. Toutes les données associées seront perdues.
                </p>
                <form action="{{ route('produits.destroy', $produit) }}"
                      method="POST"
                      onsubmit="return confirm('Êtes-vous vraiment sûr de vouloir supprimer ce produit ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-outline btn-sm gap-1">
                        <i class="fas fa-trash text-xs"></i>
                        <span class="text-xs">Supprimer ce produit</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
