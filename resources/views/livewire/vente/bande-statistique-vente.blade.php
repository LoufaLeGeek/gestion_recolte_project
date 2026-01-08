<div class="w-full  flex items-center justify-around h-40 rounded-sm gap-4 mx-auto">
    <x-statistics-kpi-card text_color="text-error" :value="$nombre_totale_vente"
        text_content="Nombre total de ventes (variétées)">
    </x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-accent" :value="$montant_totale_vente"
        text_content="Montant total des ventes">FCF</x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-success" :value="$quantite_totale_vendue"
        text_content="Quantité totale des ventes">Kg</x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-priamry" :value="$nombre_totale_produit"
        text_content="Nombre de produits vendus"></x-statistics-kpi-card>
</div>
