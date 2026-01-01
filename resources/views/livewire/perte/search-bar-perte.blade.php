<div>
    <div class="bg-base-100 p-4 flex w-fit items-end justify-center space-x-4 shadow-sm rounded-sm">
        <form class="flex items-end justify-center space-x-4" wire:submit.prevent="search">
            <div>
                <label for="varietee" class="text-[12px] font-semibold">Varietee</label>
                <input type="text" id="varietee"
                    class="input outline-none mt-1 border-none bg-primary-content/40 hover:bg-primary-content/90 focus:bg-primary-content/90"
                    placeholder="Chou rouge"
                    wire:model="varietee_nom">
            </div>
            <div>
                <label for="produit" class="text-[12px] font-semibold">Produit</label>
                <input type="text" id="produit"
                    class="input outline-none mt-1 border-none bg-primary-content/40 hover:bg-primary-content/90 focus:bg-primary-content/90"
                    placeholder="Chou"
                    wire:model="produit_nom">
            </div>
            <button class="btn btn-primary">
                <i class="fa-solid fa-filter"></i>
                Appliquer le filtre
            </button>
        </form>
    </div>
</div>
