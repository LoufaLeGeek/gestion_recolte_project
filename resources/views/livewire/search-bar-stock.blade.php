<div>
    <div class="bg-base-100 p-4 flex w-fit items-end justify-center space-x-4 shadow-sm rounded-sm">
        <form wire:submit.prevent="search" class="flex items-end justify-center space-x-4">
            <div>
                <label for="varietee_nom" class="text-[12px] font-semibold">Nom Variete</label>
                <input type="text" id="varietee_nom"
                    class="input outline-none mt-1 border-none bg-primary-content/40 hover:bg-primary-content/90 focus:bg-primary-content/90"
                    placeholder="Exp: Chou" wire:model="varietee_nom">
            </div>
            <div>
                <label for="produit_nom" class="text-[12px] font-semibold">Nom Produit</label>
                <input type="text" id="produit_nom"
                    class="input outline-none mt-1 border-none bg-primary-content/40 hover:bg-primary-content/90 focus:bg-primary-content/90"
                    placeholder="Exp: Chou rouge" wire:model="produit_nom">
            </div>
            <button class="btn btn-primary">
                <i class="fa-solid fa-filter"></i>
                Appliquer le filtre
            </button>
        </form>
        <div class="space-y-1 ml-10">
            <p class="text-[12px] font-semibold text-primary">Cliquer pour filtrer</p>
            <div class="space-x-2">
                <label class="btn btn-success text-[12px]"
                @disabled($epuise)
                >
                    <input type="checkbox" class="checkbox" wire:click="toggle('disponible')" :checked="$disponible" />
                    <span>Disponible</span>
                </label>

                <label class="btn btn-error text-[12px]"
                @disabled($disponible)
                >
                    <input type="checkbox" class="checkbox" wire:click="toggle('epuise')" :checked="$epuise" />
                    <span>Épuisé</span>
                </label>
            </div>
        </div>
    </div>
</div>
