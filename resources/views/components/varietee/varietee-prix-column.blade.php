<div class="text-center">
    <div class="inline-flex flex-col items-center">
        <span class="badge bg-green-100 badge-outline font-semibold text-green-900 text-sm">
            <i class="fas fa-money-bill-wave text-xs"></i>
            {{ number_format($varietee->prix_actuelle->prix, 0, ',', ' ') }}
        </span>
        <span class="text-xs text-gray-500">FCFA</span>
    </div>
    <div class="text-xs text-gray-500 mt-1">
        <i class="fas fa-calendar-day text-xs"></i>
        Depuis
        {{ \Carbon\Carbon::parse($varietee->prix_actuelle->date_debut ?? now())->format('D-M-Y') }}
    </div>
</div>
