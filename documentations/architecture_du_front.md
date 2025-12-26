📁 Structure des dossiers (Laravel + Blade + Livewire)

resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php          # Layout principal
│   │   ├── guest.blade.php        # Layout pour pages publiques
│   │   └── dashboard.blade.php    # Layout spécifique dashboard
│   ├── components/                 # Composants Blade réutilisables
│   │   ├── ui/                    # Composants UI génériques
│   │   │   ├── card.blade.php
│   │   │   ├── table.blade.php
│   │   │   ├── modal.blade.php
│   │   │   └── stats-card.blade.php
│   │   └── dashboard/             # Composants spécifiques dashboard
│   │       ├── filters.blade.php
│   │       ├── kpi-cards.blade.php
│   │       └── chart-container.blade.php
│   ├── pages/                     # Pages principales
│   │   ├── dashboard/
│   │   │   ├── index.blade.php    # Dashboard principal
│   │   │   ├── recoltes.blade.php # Page récoltes
│   │   │   ├── ventes.blade.php   # Page ventes
│   │   │   ├── stocks.blade.php   # Page stocks/pertes
│   │   │   └── produits.blade.php # Gestion produits/variétés
│   │   ├── auth/                  # Authentification
│   │   └── profile/               # Profil utilisateur
│   └── partials/                  # Partials réutilisables
│       ├── header.blade.php
│       ├── sidebar.blade.php
│       ├── footer.blade.php
│       └── scripts.blade.php
├── js/
│   ├── app.js                     # Point d'entrée JavaScript
│   ├── bootstrap.js               # Initialisation Alpine/Livewire
│   ├── charts/                    # Configurations Chart.js
│   │   ├── recoltes-chart.js
│   │   ├── ventes-chart.js
│   │   └── kpi-chart.js
│   └── utils/                     # Utilitaires
│       ├── filters.js
│       └── formatters.js
└── css/
    └── app.css                    # Fichier Tailwind principal



🎯 Composants Livewire
app/Http/Livewire/
├── Dashboard/
│   ├── DashboardStats.php          # Statistiques globales
│   ├── RecoltesChart.php           # Graphique récoltes
│   ├── VentesChart.php             # Graphique ventes
│   ├── PertesChart.php             # Graphique pertes
│   └── TopProduitsTable.php        # Tableau produits populaires
├── Produits/
│   ├── ProduitList.php             # Liste des produits
│   ├── ProduitForm.php             # Formulaire produit
│   ├── VarieteList.php             # Liste variétés
│   └── VarieteForm.php             # Formulaire variété
├── Recoltes/
│   ├── RecolteList.php             # Liste récoltes
│   ├── RecolteForm.php             # Formulaire récolte
│   └── RecolteFilters.php          # Filtres récoltes
├── Ventes/
│   ├── VenteList.php               # Liste ventes
│   ├── VenteForm.php               # Formulaire vente
│   └── VenteFilters.php            # Filtres ventes
├── Stocks/
│   ├── StockOverview.php           # Vue générale stock
│   ├── PerteList.php               # Liste pertes
│   └── PerteForm.php               # Formulaire perte
└── Shared/
    ├── DateRangeFilter.php         # Filtre période
    ├── ExportButton.php            # Bouton export
    └── NotificationBell.php        # Notifications