@extends('app')

@section('title', 'Créer un produit')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2"></i> <span>Produits & Variétés</span></li>
    <li><a href="{{ route('produits.index') }}"><i class="fas fa-list me-2"></i> <span>Liste des produits</span></a></li>
    <li><i class="fas fa-plus me-2"></i> <span>Nouveau produit</span></li>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Créer un nouveau produit</h1>
        <p class="text-gray-600 mt-2">Remplissez le formulaire pour ajouter un produit agricole</p>
    </div>

    <!-- Carte du formulaire -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('produits.store') }}" method="POST" class="space-y-6">
                @csrf

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
                           value="{{ old('nom_produit') }}"
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
                              required>{{ old('description_produit') }}</textarea>
                    @error('description_produit')
                        <label class="label">
                            <span class="label-text-alt text-error">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Informations complémentaires -->
                <div class="collapse collapse-arrow bg-base-200">
                    <input type="checkbox" />
                    <div class="collapse-title font-medium">
                        <i class="fas fa-info-circle me-2"></i>
                        Informations complémentaires (optionnel)
                    </div>
                    <div class="collapse-content">
                        <p class="text-sm text-gray-600 mb-4">
                            Ces informations seront disponibles dans une prochaine mise à jour.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Catégorie</span>
                                </label>
                                <select class="select select-bordered" disabled>
                                    <option>Sélectionnez une catégorie</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Saison</span>
                                </label>
                                <select class="select select-bordered" disabled>
                                    <option>Toute l'année</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="form-control pt-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="btn btn-success flex-1 gap-2">
                            <i class="fas fa-save"></i>
                            Enregistrer le produit
                        </button>
                        <a href="{{ route('produits.index') }}" class="btn btn-ghost flex-1 gap-2">
                            <i class="fas fa-times"></i>
                            Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Aide -->
    <div class="mt-8">
        <div class="alert alert-info shadow-lg">
            <div>
                <i class="fas fa-lightbulb text-2xl"></i>
                <div>
                    <h3 class="font-bold">Conseil</h3>
                    <div class="text-xs">
                        <p>• Utilisez des noms précis pour faciliter la recherche</p>
                        <p>• Décrivez bien les caractéristiques pour les utilisateurs</p>
                        <p>• Pensez à inclure les variétés principales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
