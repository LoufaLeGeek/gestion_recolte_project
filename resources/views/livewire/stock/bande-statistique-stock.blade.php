<div class="w-full flex items-center justify-around h-40 rounded-sm gap-4 mx-auto">
    <x-statistics-kpi-card text_color="text-error" :value="$nombre_varietee_stock"
        text_content="Total des variétées en stock"></x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-accent" :value="$quantite_stocks"
        text_content="Quantité totale des stocks">Kg</x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-success" :value="$repture_stocks"
        text_content="Nombre de variétées en rupture de stock"></x-statistics-kpi-card>
</div>
