@extends('app')

@section('title', 'Gestion des Récoltes')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- SECTION : TITRE --}}
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-slate-800 dark:text-slate-100">Gestion des Récoltes</h1>
        <p class="mt-2 text-slate-600 dark:text-slate-400">Ajouter, modifier, filtrer et suivre les récoltes</p>
    </div>

    {{-- SECTION : MESSAGES SUCCESS / ERREURS --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-md">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SECTION : FORMULAIRE AJOUT RECOLTE --}}
    <div class="mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-6 rounded-lg shadow-sm">
        <h2 class="text-xl font-semibold mb-4 text-slate-800 dark:text-slate-100">Ajouter une récolte</h2>
        <form method="POST" action="{{ route('recoltes.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf

            {{-- Input date avec icône calendrier --}}
            <div class="relative">
                <label class="block mb-1 text-sm font-medium text-slate-700 dark:text-slate-300">Date</label>
                <input type="date" name="date_recolte"
                    class="w-full pl-10 rounded-md border px-3 py-2 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-blue-500"
                    required>
                <div class="absolute left-3 top-9 text-slate-400 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 10h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            {{-- Input recherche et select pour variété --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-slate-700 dark:text-slate-300">Variété</label>
                <input type="text" id="search-varietee-add" placeholder="Rechercher une variété..."
                    class="mb-2 w-full rounded-md border px-3 py-2 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-blue-500">
                <select id="select-varietee-add" name="varietee_id" required
                        class="w-full rounded-md border px-3 py-2 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-blue-500">
                    <option value="">Sélectionnez une variété</option>
                    @foreach($liste_varietees as $varietee)
                        <option value="{{ $varietee->id }}">
                            {{ $varietee->produit->nom_produit }} - {{ $varietee->nom_varietee }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Input quantité --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-slate-700 dark:text-slate-300">Quantité (kg)</label>
                <input type="number" step="0.001" name="quantite_recolte"
                    class="w-full rounded-md border px-3 py-2 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            {{-- Bouton ajouter --}}
            <div class="flex items-end">
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-md px-4 py-2 transition">
                    Ajouter
                </button>
            </div>
        </form>
    </div>

    {{-- SECTION : FILTRE PAR VARIÉTÉ --}}
    <form method="GET" action="{{ route('recoltes.index') }}" class="flex items-start gap-2 mb-4">
        <div class="w-full max-w-md">
            <label class="block mb-1 text-sm font-medium text-slate-700 dark:text-slate-300">Filtrer par variété</label>
            <input type="text" id="search-varietee-filter" placeholder="Rechercher une variété..."
                class="mb-2 w-full rounded-md border px-3 py-2 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-blue-500">
            <select id="select-varietee-filter" name="varietee_id"
                    class="w-full rounded-md border px-3 py-2 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100">
                <option value="">Toutes les variétés</option>
                @foreach($liste_varietees as $varietee)
                    <option value="{{ $varietee->id }}" @selected(request('varietee_id') == $varietee->id)>
                        {{ $varietee->produit->nom_produit }} - {{ $varietee->nom_varietee }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="pt-7">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Filtrer</button>
        </div>
    </form>

    {{-- SECTION : TABLEAU DES RECOLTES --}}
    <div class="overflow-x-auto rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
            <thead class="bg-slate-50 dark:bg-slate-800">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-slate-700 dark:text-slate-300">Date Récolte</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-slate-700 dark:text-slate-300">Variété</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-slate-700 dark:text-slate-300">Produit</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-slate-700 dark:text-slate-300">Quantité (kg)</th>
                    <th class="px-4 py-2 text-center text-sm font-medium text-slate-700 dark:text-slate-300">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-900 divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($recoltes as $recolte)
                    <tr>
                        <td class="px-4 py-2">{{ $recolte->date_recolte->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ $recolte->varietee->nom_varietee }}</td>
                        <td class="px-4 py-2">{{ $recolte->varietee->produit->nom_produit }}</td>
                        <td class="px-4 py-2">{{ number_format($recolte->quantite_recolte, 3) }}</td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center gap-2">
                                <button type="button"
                                        onclick="toggleEdit({{ $recolte->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                                    Modifier
                                </button>
                                <form method="POST" action="{{ route('recoltes.destroy', $recolte->id) }}"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer cette récolte ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-slate-500">Aucune récolte enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $recoltes->links() }}
    </div>

    {{-- STATISTIQUES PAR VARIÉTÉ --}}
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4 text-slate-800 dark:text-slate-100">Statistiques par variété</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($statistiques as $stat)
                <div class="rounded-lg border border-slate-200 dark:border-slate-700 p-4 bg-white dark:bg-slate-900 shadow-sm">
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">
                        {{ $stat->varietee->produit->nom_produit }} - {{ $stat->varietee->nom_varietee }}
                    </p>
                    <p class="text-xl font-bold text-slate-800 dark:text-slate-100">
                        {{ number_format($stat->total_quantite, 3) }} kg
                    </p>
                </div>
            @endforeach
        </div>
    </div>

</div>

{{-- SCRIPTS : Toggle edition + recherche client-side --}}
<script>
    // Fonction pour afficher/cacher le formulaire inline de modification
    function toggleEdit(id) {
        document.querySelectorAll('[id^="edit-row-"]').forEach(row => {
            if (row.id !== 'edit-row-' + id) row.classList.add('hidden');
        });
        const target = document.getElementById('edit-row-' + id);
        if (target) target.classList.toggle('hidden');
    }

    // Fonction pour filtrer les options d'un select via un input de recherche
    function attachSearch(inputId, selectId) {
        const input = document.getElementById(inputId);
        const select = document.getElementById(selectId);
        if (!input || !select) return;

        const originalOptions = Array.from(select.options).map(opt => ({ value: opt.value, text: opt.text }));

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

    // Application des recherches sur les selects
    attachSearch('search-varietee-add', 'select-varietee-add');
    attachSearch('search-varietee-filter', 'select-varietee-filter');
</script>
@endsection
