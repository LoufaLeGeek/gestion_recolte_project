@extends('app')


@section('title', 'Dashboard')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>

    <div class="container space-y-8">

        <h2 class="mb-4 border-b">📊 Dashboard des Récoltes</h2>

        <!-- FILTRES  & KPI-->
        <div class="row mb-4 gap-4">

            <!-- KPI -->
            <div class="grid grid-cols-6 gap-2">
                <h5 class="mb-3 col-span-6">📊 Indicateurs clés</h5>
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


        </div>


        <!-- GRAPHIQUES -->
        <div class="grid grid-cols-6 gap-4">

            <!-- FILTRES -->
            <div class="card card-body col-span-1 shadow-lg bg-success p-4 rounded-lg bg-white">
                <h5 class="mb-3 col-span-2">🔍 Filtres</h5>
                <form method="GET" id="filtersForm" class="grid grid-cols-1 ld:grid-cols-1 gap-2">
                    <div class="col-md-4 mb-2">
                        <select name="mois" class="border rounded-lg flex py-2 items-center form-select filter w-full">
                            <option value="">📅 Tous les mois</option>
                            @foreach ($moisDisponibles as $m)
                                <option value="{{ $m }}" {{ $mois == $m ? 'selected' : '' }}>
                                    {{ $m }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <select name="produit" class="select outline-none">
                            <option value="">🌾 Tous les produits</option>
                            @foreach ($produits as $p)
                                <option value="{{ $p->id }}" {{ $produitId == $p->id ? 'selected' : '' }}>
                                    {{ $p->nom_produit }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <select name="varietee" class="select outline-none">
                            <option value="">🌾 Toutes les Varietees</option>
                            @foreach ($varietees as $v)
                                <option value="{{ $v->id }}" {{ $varieteeId == $v->id ? 'selected' : '' }}>
                                    {{ $v->nom_varietee }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

            </div>


            <x-dashboard.graphic-container title="📊 Récoltes & Ventes (comparatif)" icone="fas fa-chart-line"
                chartId="chartVentesRecoltes" style="col-span-5" />


            <x-dashboard.graphic-container title="💰 Variation des prix par variété" icone="fas fa-chart-line"
                chartId="prixParVarietee" style="col-span-3" />


            <x-dashboard.graphic-container title="🛒 Chiffre d'Affaires des Ventes" icone="fas fa-chart-line"
                chartId="chartVentes" style="col-span-3" />

            <!-- Barres -->
            <x-dashboard.graphic-container title="🌾 Récoltes par Produit en Kg" icone="fas fa-chart-bar"
                chartId="recoltesParProduit" style="col-span-3" />

        </div>
    </div>



    <script>
        window.chartVentesRecoltes = null;

        function loadVentesRecoltes() {
            const params = new URLSearchParams(
                new FormData(document.getElementById('filtersForm'))
            );

            fetch(`/dashboard/ventes-recoltes?${params}`)

                .then(res => res.json())
                .then(data => {

                    const ctx = document.getElementById('chartVentesRecoltes');
                    if (!ctx) return;

                    const labels = [
                        ...new Set([
                            ...data.recoltes.map(r => r.date),
                            ...data.ventes.map(v => v.date)
                        ])
                    ].sort();

                    const recoltesData = labels.map(date => {
                        const r = data.recoltes.find(r => r.date === date);
                        return r ? Number(r.total) : null;
                    });

                    const ventesData = labels.map(date => {
                        const v = data.ventes.find(v => v.date === date);
                        return v ? Number(v.total) : null;
                    });

                    if (window.chartVentesRecoltes) {
                        window.chartVentesRecoltes.destroy();
                    }

                    window.chartVentesRecoltes = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [{
                                    label: 'Récoltes (Kg)',
                                    data: recoltesData,
                                    borderColor: 'green',
                                    backgroundColor: 'rgba(0, 255, 100, 0.2)',
                                    yAxisID: 'yRecoltes',
                                    tension: 0.3
                                },
                                {
                                    label: 'Ventes (CFA)',
                                    data: ventesData,
                                    borderColor: 'blue',
                                    backgroundColor: 'rgba(0, 100, 255, 0.2)',
                                    yAxisID: 'yVentes',
                                    // tension: 0.9
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        color: '#555'
                                    }
                                },
                                yRecoltes: {
                                    type: 'linear',
                                    position: 'left',
                                    title: {
                                        display: true,
                                        text: 'Kg récoltés'
                                    }
                                },
                                yVentes: {
                                    type: 'linear',
                                    position: 'right',
                                    grid: {
                                        drawOnChartArea: false
                                    },
                                    title: {
                                        display: true,
                                        text: 'Montant des ventes (CFA)'
                                    }
                                }
                            }
                        }
                    });
                });
        }
        document.querySelectorAll('.filter').forEach(el => {
            el.addEventListener('change', loadVentesRecoltes);
        });

        document.addEventListener('DOMContentLoaded', loadVentesRecoltes);
    </script>




    <script>
        let chartVentes;

        function loadVentesChart() {
            const params = new URLSearchParams(
                new FormData(document.getElementById('filtersForm'))
            );

            fetch(`/dashboard/ventes-data?${params}`)
                .then(res => res.json())
                .then(data => {

                    const labels = data.ventes.map(v => v.date);
                    const values = data.ventes.map(v => v.total);

                    if (chartVentes) {
                        chartVentes.destroy();
                    }

                    chartVentes = new Chart(
                        document.getElementById('chartVentes'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Montant des ventes',
                                    data: values,
                                    borderWidth: 2,
                                    tension: 0.3,
                                    fill: false
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom' // légende à gauche
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: false
                                    }
                                }
                            }
                        }
                    );
                });
        }

        document.querySelectorAll('.filter').forEach(el => {
            el.addEventListener('change', loadVentesChart);
        });

        loadVentesChart();
    </script>


    <script>
        let chartPrix;

        function loadDashboard() {

            const params = new URLSearchParams(
                new FormData(document.getElementById('filtersForm'))
            );

            fetch(`/dashboard/data?${params}`)
                .then(res => res.json())
                .then(data => {


                    if (chartPrix) {
                        chartPrix.destroy();
                        chartPrix = null;
                    }

                    const labels = [
                        ...new Set(
                            Object.values(data.prixParVarietee)
                            .flat()
                            .map(p => p.date_debut)
                        )
                    ];

                    const datasets = Object.entries(data.prixParVarietee)
                        .map(([varietee, valeurs], i) => ({
                            label: varietee,
                            data: labels.map(d => {
                                const found = valeurs.find(v => v.date_debut === d);
                                return found ? found.prix : null;
                            }),
                            borderWidth: 2,
                            tension: 0.4
                        }));

                    chartPrix = new Chart(
                        document.getElementById('prixParVarietee'), {
                            type: 'line',
                            data: {
                                labels,
                                datasets
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'left',
                                    },
                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: 'line'
                                    }
                                },
                                scales: {
                                    x: {
                                        beginAtZero: true,
                                        offset: true,
                                        layouts: {
                                            padding: {
                                                left: 10,
                                                right: 10,
                                                top: 10,
                                                bottom: 10
                                            }
                                        },
                                        ticks: {
                                            color: '#555',
                                            font: {
                                                size: 12
                                            }
                                        },
                                        grid: {
                                            color: 'rgba(0, 255, 100, 0.2)'
                                        }
                                    },
                                    y: {
                                        beginAtZero: false,
                                        ticks: {
                                            color: '#555'
                                        },
                                        grid: {
                                            color: 'rgba(0, 255, 100, 0.2)'
                                        }
                                    }
                                },
                            }
                        }
                    );
                });
        }
        // 🔁 Recharge automatique
        document.querySelectorAll('.filter').forEach(el =>
            el.addEventListener('change', loadDashboard)
        );
        loadDashboard();
    </script>




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
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 100, 255, 0.7)',
                        titleColor: '#000',
                        bodyColor: '#fff',
                        borderWidth: 1,
                        padding: 5,
                        FontFaceSetLoadEvent: true
                    },
                    legend: {
                        position: 'bottom',
                        usePointStyle: true,
                        labels: {
                            color: '#000',
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#555',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(0, 255, 100, 0.2)'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#555'
                        },
                        grid: {
                            color: 'rgba(0, 255, 100, 0.2)'
                        }
                    }
                },
            }
        });
    </script>


    <script>
        const mois = @json($recoltesParMois->pluck('mois'));
        const valeursMois = @json($recoltesParMois->pluck('total'));
        new Chart(document.getElementById('recoltesParMois'), {
            type: 'line',
            data: {
                labels: mois,
                datasets: [{
                    label: 'Récoltes mensuelles',
                    data: valeursMois,
                    fill: true,
                    backgroundColor: 'rgba(0, 255, 100, 0.3)', // remplissage
                    pointBackgroundColor: 'green',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 255, 100, 0.7)',
                        titleColor: '#000',
                        bodyColor: 'green',
                        borderWidth: 1,
                        padding: 5,
                        FontFaceSetLoadEvent: true
                    },
                    legend: {
                        position: 'bottom',
                        usePointStyle: true,
                        labels: {
                            color: 'orange',
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'orange',
                            font: {
                                size: 13,
                                weight: '100'
                            },
                            fontFamily: 'roboto, sans-serif'
                        },
                        grid: {
                            color: 'rgba(0, 255, 100, 0.1)'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'green'
                        },
                        grid: {
                            color: 'rgba(0, 255, 100, 0.1)'
                        }
                    }
                },
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

@endsection
