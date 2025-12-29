<div class="w-full px-10 flex items-center justify-around h-40 rounded-sm gap-4 mx-auto">
    <div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center shadow-xs">
        <h1 class="text-error text-center">{{$nombre_totale_vente}}</h1>
        <span class="font-semibold text-[12px] ">Nombre totale de ventes (varietees)</span>
    </div>
    <div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center shadow-xs">
        <h1 class="text-accent text-center">{{ $montant_totale_vente }} FCA</h1>
        <span class="font-semibold text-[12px]">Montant totale des ventes</span>
    </div>
    <div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center shadow-xs">
        <h1 class="text-success text-center">{{ $quantite_totale_vendue }} Kg</h1>
        <span class="font-semibold text-[12px]">Quantite totale des ventest</span>
    </div>
    <div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center shadow-xs">
        <h1 class="text-priamry text-center">{{ $nombre_totale_produit }}</h1>
        <span class="font-semibold text-[12px]">Nombre de produits vendue</span>
    </div>
</div>
