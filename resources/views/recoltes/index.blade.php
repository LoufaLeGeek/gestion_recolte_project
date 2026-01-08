@extends('app')

@section('title', 'Gestion des Récoltes')

@section('content')
    <div class="space-y-8">

        <x-title-page
    class_icon="fas fa-seedling text-yellow-500"
    title="Gestion des récoltes"
    sub_title="Enregistrement, suivi et analyse des quantités récoltées"
></x-title-page>

        <div class="bg-base-100 p-4 shadow-sm rounded-sm space-y-2 w-fit">
            <p class="font-semibold">Ajouter une récolte</p>
            <form method="POST" action="{{ route('recoltes.store') }}" class="flex items-end gap-4">
                @csrf
                <div>
                    <label class="text-[12px] font-semibold block mb-1">Date</label>
                    <input type="date" name="date_recolte" class="input outline-none w-full" required>
                </div>

                <div>
                    <label for="" class="text-[12px] font-semibold block mb-1">Selectionner une varietee</label>
                    <select id="select-varietee-add" name="varietee_id" required class="select outline-none">
                        <option value="">Sélectionnez une variété</option>
                        @foreach ($liste_varietees as $varietee)
                            <option value="{{ $varietee->id }}">
                                {{ $varietee->produit->nom_produit }} - {{ $varietee->nom_varietee }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-[12px] font-semibold block mb-1">Quantité (kg)</label>
                    <input type="text" placeholder="120.00" name="quantite_recolte" class="input outline-none" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Ajouter une recolte
                </button>

            </form>
        </div>

        {{-- SECTION : MESSAGES SUCCESS / ERREURS --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-md">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- SECTION : FILTRE PAR VARIÉTÉ --}}
        <form method="GET" action="{{ route('recoltes.index') }}"
            class="flex items-end gap-4 bg-base-100 rounded-sm shadow-sm w-fit p-4">
            <div>
                <label class="block mb-1 text-[12px] font-semibold">Rechercher la varietee</label>
                <input type="text" id="search-varietee-filter" placeholder="Rechercher une variété..."
                    class="input outline-none w-90">
            </div>
            <div>
                <label class="block mb-1 text-[12px] font-semibold">Selectioner la varietee</label>
                <select id="select-varietee-filter" name="varietee_id" class="select outline-none w-90">
                    <option value="">Toutes les variétés</option>
                    @foreach ($liste_varietees as $varietee)
                        <option value="{{ $varietee->id }}" @selected(request('varietee_id') == $varietee->id)>
                            {{ $varietee->produit->nom_produit }} - {{ $varietee->nom_varietee }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i>
                Appliquer le filtre
            </button>
        </form>

        {{-- SECTION : TABLEAU DES RECOLTES --}}
        <div class="space-y-4">
            <table
                class="w-full table [&_tr]:border-0 [&_td]:border-0 [&_th]:border-0  border-separate border-spacing-y-3 bg-base-100 shadow-sm">
                <thead class="[&_tr]:font-bold [&_tr]:text-base-content">
                    <tr>
                        <th>id</th>
                        <th>Produit</th>
                        <th>Variété</th>
                        <th>Date récolte</th>
                        <th>Quantité (kg)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="[&_tr]:text-sm [&_tr]:hover:bg-base-content/10">
                    @forelse($recoltes as $recolte)
                        <tr>
                            <td>
                                <span>
                                    #{{ $recolte->id }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-green-300/30">
                                    {{ $recolte->varietee->produit->nom_produit }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-soft badge-error">{{ $recolte->varietee->nom_varietee }}</span>
                            </td>

                            <td>
                                <span class="badge badge-soft badge-base">
                                    {{ $recolte->date_recolte->format('d/m/Y') }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-soft badge-accent">
                                    {{ number_format($recolte->quantite_recolte, 3) }}
                                </span>
                            </td>

                            <td class="flex gap-4 items-center">
                                <button type="button" onclick="toggleEdit({{ $recolte->id }})"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                    Modifier
                                </button>
                                @if ($recolte?->id)
                                    <form method="POST" action="{{ route('recoltes.destroy', $recolte->id) }}"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cette récolte ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-error">
                                            <i class="fas fa-trash"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-slate-500">Aucune récolte
                                enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINATION --}}
            <div class="mt-4">
                {{ $recoltes->links() }}
            </div>
        </div>
    </div>


    {{-- SCRIPTS : Toggle edition + recherche client-side --}}
    <script>
        function toggleEdit(id) {
            document.querySelectorAll('[id^="edit-row-"]').forEach(row => {
                if (row.id !== 'edit-row-' + id) row.classList.add('hidden');
            });
            const target = document.getElementById('edit-row-' + id);
            if (target) target.classList.toggle('hidden');
        }

        function attachSearch(inputId, selectId) {
            const input = document.getElementById(inputId);
            const select = document.getElementById(selectId);
            if (!input || !select) return;

            const originalOptions = Array.from(select.options).map(opt => ({
                value: opt.value,
                text: opt.text
            }));

            input.addEventListener('input', () => {
                const term = input.value.toLowerCase().trim();
                select.innerHTML = '';
                originalOptions
                    .filter(opt => opt.text.toLowerCase().includes(term))
                    .forEach(opt => {
                        const o = document.createElement('option');
                        o.value = opt.value;
                        o.text = opt.text;
                        select.appendChild(o);
                    });
            });
        }
        attachSearch('search-varietee-add', 'select-varietee-add');
        attachSearch('search-varietee-filter', 'select-varietee-filter');
    </script>
@endsection
