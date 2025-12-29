@extends('app')

@section('title', 'Créer un produit')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><a href="{{ route('produits.index') }}"><i class="fas fa-list me-2 text-sm"></i> <span class="text-sm">Liste des produits</span></a></li>
    <li><i class="fas fa-plus me-2 text-sm"></i> <span class="text-sm">Nouveau produit</span></li>
@endsection

@section('content')
<div class="max-w-3xl mx-auto px-2 sm:px-4">
    <!-- En-tête -->
    <div class="mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Créer un nouveau produit</h1>
        <p class="text-gray-600 text-sm mt-1">Remplissez le formulaire pour ajouter un produit agricole</p>
    </div>

    <!-- Carte du formulaire -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body p-3 sm:p-4">
            <form action="{{ route('produits.store') }}" method="POST" class="space-y-4">
                @csrf

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
                           value="{{ old('nom_produit') }}"
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
                              class="textarea textarea-bordered textarea-sm sm:textarea-md h-32 sm:h-40 @error('description_produit') textarea-error @enderror"
                              placeholder="Décrivez le produit, ses caractéristiques, ses variétés..."
                              required>{{ old('description_produit') }}</textarea>
                    @error('description_produit')
                        <label class="label py-1">
                            <span class="label-text-alt text-error text-xs">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Informations complémentaires -->
                <div class="collapse collapse-arrow bg-base-200">
                    <input type="checkbox" />
                    <div class="collapse-title font-medium text-sm p-3">
                        <i class="fas fa-info-circle me-2 text-xs"></i>
                        Informations complémentaires (optionnel)
                    </div>
                    <div class="collapse-content p-3">
                        <p class="text-xs text-gray-600 mb-3">
                            Ces informations seront disponibles dans une prochaine mise à jour.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="form-control">
                                <label class="label py-1">
                                    <span class="label-text text-xs">Catégorie</span>
                                </label>
                                <select class="select select-bordered select-sm" disabled>
                                    <option class="text-xs">Sélectionnez une catégorie</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label py-1">
                                    <span class="label-text text-xs">Saison</span>
                                </label>
                                <select class="select select-bordered select-sm" disabled>
                                    <option class="text-xs">Toute l'année</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="form-control pt-4">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <button type="submit" class="btn btn-success btn-sm sm:btn-md flex-1 gap-1">
                            <i class="fas fa-save text-xs sm:text-sm"></i>
                            <span class="text-xs sm:text-sm">Enregistrer le produit</span>
                        </button>
                        <a href="{{ route('produits.index') }}" class="btn btn-ghost btn-sm sm:btn-md flex-1 gap-1">
                            <i class="fas fa-times text-xs sm:text-sm"></i>
                            <span class="text-xs sm:text-sm">Annuler</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Aide -->
    <div class="mt-6">
        <div class="alert alert-info shadow-md">
            <div class="flex items-start gap-2">
                <i class="fas fa-lightbulb text-lg mt-1"></i>
                <div>
                    <h3 class="font-bold text-sm">Conseil</h3>
                    <div class="text-xs mt-1">
                        <p class="mb-1">• Utilisez des noms précis pour faciliter la recherche</p>
                        <p class="mb-1">• Décrivez bien les caractéristiques pour les utilisateurs</p>
                        <p>• Pensez à inclure les variétés principales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
