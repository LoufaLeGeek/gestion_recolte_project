@extends('app')

@section('title', 'Modifier la variété')
@section('breadcrumb')
    <li><i class="fas fa-carrot me-2 text-sm"></i> <span class="text-sm">Produits & Variétés</span></li>
    <li><a href="{{ route('varietees.index') }}"><i class="fas fa-leaf me-2 text-sm"></i> <span class="text-sm">Liste des variétés</span></a></li>
    <li><i class="fas fa-edit me-2 text-sm"></i> <span class="text-sm">Modifier {{ $varietee->nom_varietee }}</span></li>
@endsection

@section('content')

<div class="max-w-3xl mx-auto px-2 sm:px-4">
    <!-- En-tête avec icône -->
    <div class="mb-6 flex items-center gap-3">
        <div class="avatar placeholder">
            <div class="flex items-center justify-center bg-green-100 text-green-600 rounded-full w-10 h-10">
                <i class="fas fa-leaf text-base"></i>
            </div>
        </div>
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Modifier la variété</h1>
            <p class="text-gray-600 text-sm mt-1">Mettez à jour les informations de {{ $varietee->nom_varietee }}</p>
        </div>
    </div>

    <!-- Carte du formulaire -->
    <div class="card bg-base-100 shadow-md">
        <div class="card-body p-3 sm:p-4">
            <form action="{{ route('varietees.update', $varietee) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nom de la variété -->
                <div class="form-control">
                    <label class="label py-1">
                        <span class="label-text font-semibold text-sm">
                            <i class="fas fa-tag me-2 text-green-500 text-xs"></i>
                            Nom de la variété
                        </span>
                        <span class="label-text-alt text-error text-xs">* Requis</span>
                    </label>
                    <input type="text"
                           name="nom_varietee"
                           value="{{ old('nom_varietee', $varietee->nom_varietee) }}"
                           class="input input-bordered input-sm sm:input-md w-full @error('nom_varietee') input-error @enderror"
                           placeholder="Ex: Golden Delicious, Roma, Hass..."
                           required>
                    @error('nom_varietee')
                        <label class="label py-1">
                            <span class="label-text-alt text-error text-xs">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        </label>
                    @enderror
                </div>

                <!-- Sélection du produit -->
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
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}"
                                    {{ old('produit_id', $varietee->produit_id) == $produit->id ? 'selected' : '' }}>
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
                              class="textarea textarea-bordered textarea-sm sm:textarea-md h-32 sm:h-40  @error('caracteristique_varietee') textarea-error @enderror"
                              placeholder="Décrivez les caractéristiques spécifiques de cette variété..."
                              required>{{ old('caracteristique_varietee', $varietee->caracteristique_varietee) }}</textarea>
                    @error('caracteristique_varietee')
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
                        <div class="text-gray-700">{{ $varietee->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                    <div class="bg-base-200 rounded p-3">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-calendar-check text-green-500 text-xs"></i>
                            <span class="font-medium">Dernière modification</span>
                        </div>
                        <div class="text-gray-700">{{ $varietee->updated_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>
<!-- Nouveau prix -->
<div class="form-control">
    <label class="label py-1">
        <span class="label-text font-semibold text-sm">
            <i class="fas fa-money-bill-wave me-2 text-green-500 text-xs"></i>
            Prix actuel
        </span>
        <span class="label-text-alt text-error text-xs">* Requis pour modification</span>
    </label>

    <!-- Affichage du prix actuel -->
    <div class="mb-2 p-2 bg-base-200 rounded">
        <div class="flex justify-between items-center">
            <span class="text-sm font-medium">Prix actuel :</span>
            <span class="text-lg font-bold text-green-600">
                {{ $varietee->prix_formate ?? 'Non défini' }}
            </span>
        </div>
        @if($varietee->prix_actuelle)
            <div class="text-xs text-gray-600 mt-1">
                <i class="fas fa-calendar-alt me-1"></i>
                En vigueur depuis le {{ $varietee->prix_actuelle->date_debut->format('d/m/Y') }}
            </div>
        @endif
    </div>

    <!-- Champ pour le nouveau prix -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
            <label class="label py-1">
                <span class="label-text text-xs">Nouveau prix</span>
                <span class="label-text-alt text-error text-xs">FCFA</span>
            </label>
            <input type="number"
                   name="nouveau_prix"
                   step="0.01"
                   min="0"
                   class="input input-bordered input-sm sm:input-md w-full @error('nouveau_prix') input-error @enderror"
                   placeholder="Ex: 1500.50"
                   value="{{ old('nouveau_prix') }}">
        </div>
    </div>

    <div class="mt-1">
        <label class="label cursor-pointer justify-start gap-2 py-1">
            <input type="checkbox"
                   name="changer_prix"
                   class="checkbox checkbox-xs checkbox-primary"
                   {{ old('changer_prix') ? 'checked' : '' }}>
            <span class="label-text text-xs">Je souhaite modifier le prix</span>
        </label>
    </div>

    @error('nouveau_prix')
        <label class="label py-1">
            <span class="label-text-alt text-error text-xs">
                <i class="fas fa-exclamation-circle me-1"></i>
                {{ $message }}
            </span>
        </label>
    @enderror
    @error('date_effet')
        <label class="label py-1">
            <span class="label-text-alt text-error text-xs">
                <i class="fas fa-exclamation-circle me-1"></i>
                {{ $message }}
            </span>
        </label>
    @enderror
</div>
                <!-- Boutons d'action -->
                <div class="form-control pt-4">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <button type="submit" class="btn btn-success btn-sm sm:btn-md flex-1 gap-1">
                            <i class="fas fa-save text-xs sm:text-sm"></i>
                            <span class="text-xs sm:text-sm">Mettre à jour</span>
                        </button>
                        <a href="{{ route('varietees.show', $varietee) }}" class="btn btn-info btn-sm sm:btn-md flex-1 gap-1">
                            <i class="fas fa-eye text-xs sm:text-sm"></i>
                            <span class="text-xs sm:text-sm">Voir détails</span>
                        </a>
                        <a href="{{ route('varietees.index') }}" class="btn btn-ghost btn-sm sm:btn-md flex-1 gap-1">
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
        <div class="card bg-white bg-opacity-10 border border-error border-opacity-30">
            <div class="card-body p-3 sm:p-4">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fas fa-exclamation-triangle text-error text-base"></i>
                    <h3 class="font-bold text-error text-sm">Zone de danger</h3>
                </div>
                <p class="text-xs text-gray-700 mb-3">
                    La suppression est définitive. Cette variété sera retirée de tous les enregistrements associés.
                </p>
                <form action="{{ route('varietees.destroy', $varietee) }}"
                      method="POST"
                      onsubmit="return confirm('Êtes-vous vraiment sûr de vouloir supprimer cette variété ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-outline btn-sm gap-1">
                        <i class="fas fa-trash text-xs"></i>
                        <span class="text-xs">Supprimer cette variété</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.querySelector('input[name="changer_prix"]');
    const prixInput = document.querySelector('input[name="nouveau_prix"]');
    const dateInput = document.querySelector('input[name="date_effet"]');

    function togglePrixFields() {
        const isChecked = checkbox.checked;
        prixInput.disabled = !isChecked;
        dateInput.disabled = !isChecked;

        if (!isChecked) {
            prixInput.value = '';
            dateInput.value = '{{ now()->format("Y-m-d") }}';
        }
    }

    // Initial state
    togglePrixFields();

    // On change
    checkbox.addEventListener('change', togglePrixFields);
});
</script>
@endpush
@endsection
