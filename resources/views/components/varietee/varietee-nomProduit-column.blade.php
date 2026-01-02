<div class="flex items-center gap-2">
    <div class="avatar placeholder">
        <div class="flex items-center justify-center bg-orange-100 text-orange-600 rounded-full w-6 h-6">
            <i class="fas fa-carrot text-xs"></i>
        </div>
    </div>
    <a href="{{ route('produits.show', $varietee->produit_id) }}"
        class="text-blue-600 hover:text-blue-800 text-xs sm:text-sm">
        {{ $varietee->produit->nom_produit ?? 'N/A' }}
    </a>
</div>
