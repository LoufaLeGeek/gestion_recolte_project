@extends('app')


@section('title', 'Dashboard')

@section('content')


    <style>
        /* .chart-container {
        height: 320px;   /* 👈 hauteur du graphique */
        width: 100%;
        /* largeur responsive */
        }

        */
    </style>
    <div class="container">

        <h2 class="mb-4 border-b">📊 Dashboard des Récoltes</h2>



        <!-- FILTRES  & KPI-->
        <div class="grid grid-cols-3 row mb-4 gap-4">
            <!-- KPI -->
            <div class="grid grid-cols-3 col-span-2 gap-2">
                <h5 class="mb-3 col-span-3">📊 Indicateurs clés</h5>
                <x-dashboard.card-stat type="Quantite Totale Recoltee" :value="$totalRecolte" unite="Kg"
                    icone="fas fa-calendar-day" color="green" class="bg-white mb-4" />

                <x-dashboard.card-stat type="Nombre de récoltes" :value="$nbRecoltes" unite="jours"
                    icone="fas fa-calendar-day" color="blue" class="bg-white mb-4" />

                <x-dashboard.card-stat type="Moyenne de récolte" :value="$moyenneRecolte" unite="Kg"
                    icone="fas fa-calendar-day" color="orange" class="bg-white mb-4" />

                <x-dashboard.card-stat type="Chiffre d'Affaires" :value="$chiffreAffaires" unite="Francs CFA"
                    icone="fas fa-calendar-day" color="gray" class="bg-white mb-4" />

                <x-dashboard.card-stat type="Quantite Perdu" :value="$totalePertes" unite="Kg" icone="fas fa-calendar-day"
                    color="gray" class="bg-white mb-4" />

                <x-dashboard.card-stat type="Quantite Stockee" :value="$quantiteStockee" unite="Kg" icone="fas fa-calendar-day"
                    color="gray" class="bg-white mb-4" />
            </div>
            <!-- FILTRES -->
            <div class="card p-4 rounded-lg bg-white">
                <h5 class="mb-3 col-span-2">🔍 Filtres</h5>
                <form method="GET" id="filtersForm" class="grid grid-cols-2 gap-2">
                    <div class="col-md-4 mb-2 border rounded-lg flex items-center py-2">
                        <select name="mois" class="form-select filter">
                            <option value="">📅 Tous les mois</option>
                            @foreach ($moisDisponibles as $m)
                                <option value="{{ $m }}" {{ $mois == $m ? 'selected' : '' }}>
                                    {{ $m }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-2">
                        <select name="produit" class="border rounded-lg flex py-2 items-center form-select filter">
                            <option value="">🌾 Tous les produits</option>
                            @foreach ($produits as $p)
                                <option value="{{ $p->id }}" {{ $produitId == $p->id ? 'selected' : '' }}>
                                    {{ $p->nom_produit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

            </div>
        </div>


        <!-- GRAPHIQUES -->
        <div class="row grid grid grid-cols-2 gap-4">
            <!-- Courbe -->

            <x-dashboard.graphic-container title="📅 Récoltes par Mois en Kg" icone="fas fa-chart-line"
                chartId="recoltesParMois" />

            <!-- Barres -->
            <x-dashboard.graphic-container title="🌾 Récoltes par Produit en Kg" icone="fas fa-chart-bar"
                chartId="recoltesParProduit" />

        </div>
    </div>


    <script>
        const labels = @json($recoltesParProduit->pluck('nom_produit'));
        const data = @json($recoltesParProduit->pluck('total'));

        new Chart(document.getElementById('recoltesParProduit'), {
            type: 'bar',

            data: {
                labels: labels,
                datasets: [{
                    label: 'Récoltes par Produit (kg)',
                    data: data,
                }]
            },
        });
    </script>


    <script>
        const mois = @json($recoltesParMois->pluck('mois'));
        const valeursMois = @json($recoltesParMois->pluck('total'));

        new Chart(document.getElementById('recoltesParMois'), {
            type: 'bar',
            data: {
                labels: mois,
                datasets: [{
                    label: 'Récoltes mensuelles',
                    data: valeursMois,
                    fill: true,
                    borderColor: 'red', // couleur de la ligne
                    backgroundColor: 'green', // remplissage
                    pointBackgroundColor: 'green',
                }]
            }
        });
        
    </script>

    <script>
    document.querySelectorAll('.filter').forEach(el => {
        el.addEventListener('change', () => {
            document.getElementById('filtersForm').submit();
        });
    });
</script>
<script>
    document.getElementById('filtersForm').addEventListener('submit', () => {
        document.body.classList.add('opacity-50');
    });
</script>

@endsection
