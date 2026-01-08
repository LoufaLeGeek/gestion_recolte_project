<div class="w-full py-5 flex items-center justify-around rounded-sm gap-4 mx-auto">
    <x-statistics-kpi-card text_color="text-error" :value="$nombre_perte" text_content="Total des pertes enregistrées"></x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-accent" :value="$montant_totale" text_content="Valeur totale estimée des pertes">FCF</x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-success" :value="$quantite_totale" text_content="Quantité totale perdue">Kg</x-statistics-kpi-card>
    <x-statistics-kpi-card text_color="text-priamry" :value="$nombre_produit" text_content="Nombre de produits impactés par les pertes"></x-statistics-kpi-card>
</div>
