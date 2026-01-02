<div class="text-center flex flex-col  space-y-1">
    @if($varietee->prix_actuelle)
    <div class="inline-flex flex-col items-center">
        <span class="badge bg-green-100 badge-outline font-semibold text-green-900 text-sm">
            <i class="fas fa-money-bill-wave text-xs"></i>
            {{ ($varietee->prix_actuelle ? number_format($varietee->prix_actuelle->prix, 0, ',', ' ') : 'N/A') }}
        </span>
        <span class="text-xs text-gray-500">FCFA</span>
    </div>
    <div class="text-xs text-gray-500 mt-1">
        <i class="fas fa-calendar-day text-xs"></i>
        Depuis
        {{ \Carbon\Carbon::parse($varietee->prix_actuelle->date_debut ?? now())->format('D-M-Y') }}
    </div>
    @else
    <span class="badge bg-red-100 badge-outline font-semibold text-red-900 text-sm">
        <i class="fas fa-exclamation-triangle text-xs"></i>
        Aucun prix défini
    </span>
    <h8><a href="{{ route('varietees.edit', $varietee) }}" class=""
        title="Modifier">
        Veuillez ajouter un prix en cliquant sur le bouton
        <i class="fas fa-edit text-[10px]"></i>
        <span class="hidden xs:inline text-xs">Éditer</span>
    </a>.</h8>
    @endif
</div>
