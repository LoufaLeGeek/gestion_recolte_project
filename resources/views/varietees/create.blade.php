@extends('app')

@section('title', 'Créer une variété')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><a href="{{ route('varietees.index') }}"><i class="fas fa-leaf me-2 text-sm"></i> <span class="text-sm">Liste des
                variétés</span></a></li>
    <li><i class="fas fa-plus me-2 text-sm"></i> <span class="text-sm">Nouvelle variété</span></li>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto px-2 sm:px-4">
        <!-- En-tête -->
        <div class="mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Créer une nouvelle variété</h1>
            <p class="text-gray-600 text-sm mt-1">Ajoutez une variété à votre catalogue de produits</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="card bg-base-100 shadow-md">
            <div class="card-body p-3 sm:p-4">
                <form action="{{ route('varietees.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Nom de la variété -->
                    <div class="form-control">
                        <label class="label py-1">
                            <span class="label-text font-semibold text-sm">
                                <i class="fas fa-tag me-2 text-green-500 text-xs"></i>
                                Nom de la variété
                            </span>
                            <span class="label-text-alt text-error text-xs">* Requis</span>
                        </label>
                        <input type="text" name="nom_varietee" value="{{ old('nom_varietee') }}"
                            class="input input-bordered input-sm sm:input-md w-full @error('nom_varietee') input-error @enderror"
                            placeholder="Ex: Golden Delicious, Roma, Hass..." required>
                        @error('nom_varietee')
                            <label class="label py-1">
                                <span class="label-text-alt text-error text-xs">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </span>
                            </label>
                        @enderror
                    </div>

                    <!-- Dans resources/views/varietees/create.blade.php, modifier la section du select -->
                    <div class="form-control">
                        <label class="label py-1">
                            <span class="label-text font-semibold text-sm">
                                <i class="fas fa-carrot me-2 text-orange-500 text-xs"></i>
                                Produit associé
                            </span>
                            <span class="label-text-alt text-error text-xs">* Requis</span>
                        </label>
                        <select name="produit_id"
                            class="select select-bordered select-sm sm:select-md w-full @error('produit_id') select-error @enderror"
                            required>
                            <option value="">Sélectionnez un produit</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}"
                                    {{ (old('produit_id') ?? $selectedProduitId) == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->nom_produit }}
                                </option>
                            @endforeach
                        </select>
                        @error('produit_id')
                            <label class="label py-1">
                                <span class="label-text-alt text-error text-xs">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </span>
                            </label>
                        @enderror
                    </div>

                    <!-- Caractéristiques -->
                    <div class="form-control">
                        <label class="label py-1">
                            <span class="label-text font-semibold text-sm">
                                <i class="fas fa-align-left me-2 text-blue-500 text-xs"></i>
                                Caractéristiques
                            </span>
                            <span class="label-text-alt text-error text-xs">* Requis</span>
                        </label>
                        <textarea name="caracteristique_varietee"
                        style="resize: none"
                            class="textarea textarea-bordered textarea-sm sm:textarea-md h-32 sm:h-40 @error('caracteristique_varietee') textarea-error @enderror"
                            placeholder="Décrivez les caractéristiques spécifiques de cette variété : couleur, taille, goût, période de maturation, résistance..."
                            required>{{ old('caracteristique_varietee') }}</textarea>
                        @error('caracteristique_varietee')
                            <label class="label py-1">
                                <span class="label-text-alt text-error text-xs">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </span>
                            </label>
                        @enderror
                        <label class="label py-1">
                            <span class="label-text-alt text-info text-xs">
                                <i class="fas fa-info-circle me-1"></i>
                                Minimum 10 caractères
                            </span>
                        </label>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="form-control pt-4">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button type="submit" class="btn btn-success btn-sm sm:btn-md flex-1 gap-1">
                                <i class="fas fa-save text-xs sm:text-sm"></i>
                                <span class="text-xs sm:text-sm">Enregistrer la variété</span>
                            </button>
                            <a href="{{ route('varietees.index') }}" class="btn btn-ghost btn-sm sm:btn-md flex-1 gap-1">
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
                        <h3 class="font-bold text-sm">Conseils pour les variétés</h3>
                        <div class="text-xs mt-1">
                            <p class="mb-1">• Utilisez des noms standardisés (ex: 'Golden Delicious' pour pommes)</p>
                            <p class="mb-1">• Notez les caractéristiques uniques (goût, texture, couleur)</p>
                            <p class="mb-1">• Mentionnez la période de récolte optimale</p>
                            <p>• Indiquez la résistance aux maladies si connue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
