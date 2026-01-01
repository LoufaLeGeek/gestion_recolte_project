<div>
    <div class="w-full flex justify-end">
        <button class="btn btn-primary" wire:click="toggle_overlary">
            <i class="fa-solid fa-plus"></i>
            Ajouter une perte
        </button>
    </div>

    @if ($toggle)
        <div class="inset-0  backdrop-blur-[0.8px] fixed bg-base-100/10 z-1000 ">
            {{-- content Overlay --}}
            <div
                class="bg-base-100 w-120 rounded-lg p-4 border border-base-300 space-y-4 absolute right-4 top-40 shadow-sm">
                {{-- Head Overlay --}}
                <div class="flex items-center justify-between">
                    <div class="flex gap-4 items-center">
                        <i class="fa-solid fa-plus"></i>
                        <p>Ajouter une perte</p>
                    </div>
                    <div class=" bg-error text-error-content rounded-full w-6 h-6 flex items-center justify-center hover:scale-[1.2] duration-200"
                        wire:click="toggle_overlary">
                        <i class="fa-solid fa-x text-[10px]"></i>
                    </div>
                </div>
                {{-- Form content --}}
                <form class="space-y-4" wire:submit.prevent="save">
                    {{-- Select input --}}
                    <div>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Selectionner la varietee</legend>
                            <select class="select outline-none w-full" wire:model="varietee_id">
                                <option>Nom de la varietee</option>
                                @foreach ($varietees as $id => $nom)
                                    <option value="{{ $id }}">{{ $nom }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                        <div>
                            @error('varietee_id')
                                <p class="text-[12px] text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- simple input --}}
                    <div>
                        <label for="quantite" class="text-[12px] font-semibold">Qantite(Kg)</label>
                        <input id="quantite" type="text" placeholder="Exp(Kg): 211.90"
                            class="input w-full outline-none mt-1" wire:model="quantite_perdu" />
                        <div>
                            @error('quantite_perdu')
                                <p class="text-[12px] text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="quantite" class="text-[12px] font-semibold">Motif</label>
                        <textarea class="textarea w-full outline-none mt-1 resize-none h-30"
                            placeholder="Exp: Détérioration ou rupture de stock ayant causé une perte." wire:model="motif"></textarea>
                        <div>
                            @error('motif')
                                <p class="text-[12px] text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- btn --}}
                    <div class="space-x-8">
                        <button class="btn bg-green-500 text-base-content w-40">Ajouter</button>
                        <button class="btn bg-error text-error-content w-40">Effacer</button>
                    </div>
                </form>
            </div>
        </div>

    @endif

</div>
