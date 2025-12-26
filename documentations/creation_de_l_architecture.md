📁 1. Création des Layouts

# Création des layouts
php artisan make:component Layouts/App
php artisan make:component Layouts/Guest
php artisan make:component Layouts/Dashboard

# Ou créer les fichiers manuellement avec artisan view
php artisan make:view layouts.app --extends=layouts.base
php artisan make:view layouts.guest
php artisan make:view layouts.dashboard


📄 2. Création des Pages Principales

# Pages Dashboard
php artisan make:view pages.dashboard.index
php artisan make:view pages.dashboard.recoltes
php artisan make:view pages.dashboard.ventes
php artisan make:view pages.dashboard.stocks
php artisan make:view pages.dashboard.produits

# Pages Authentification
php artisan make:view pages.auth.login
php artisan make:view pages.auth.register
php artisan make:view pages.auth.forgot-password

# Pages Profil
php artisan make:view pages.profile.show
php artisan make:view pages.profile.edit



🧩 3. Création des Composants Livewire

# Dashboard Livewire Components
php artisan make:livewire Dashboard/DashboardStats
php artisan make:livewire Dashboard/RecoltesChart
php artisan make:livewire Dashboard/VentesChart
php artisan make:livewire Dashboard/PertesChart
php artisan make:livewire Dashboard/PrixChart
php artisan make:livewire Dashboard/TopProduitsTable

# Produits Livewire Components
php artisan make:livewire Produits/ProduitList
php artisan make:livewire Produits/ProduitForm
php artisan make:livewire Produits/VarieteList
php artisan make:livewire Produits/VarieteForm

# Récoltes Livewire Components
php artisan make:livewire Recoltes/RecolteList
php artisan make:livewire Recoltes/RecolteForm
php artisan make:livewire Recoltes/RecolteFilters

# Ventes Livewire Components
php artisan make:livewire Ventes/VenteList
php artisan make:livewire Ventes/VenteForm
php artisan make:livewire Ventes/VenteFilters

# Stocks Livewire Components
php artisan make:livewire Stocks/StockOverview
php artisan make:livewire Stocks/PerteList
php artisan make:livewire Stocks/PerteForm

# Shared Livewire Components
php artisan make:livewire Shared/DateRangeFilter
php artisan make:livewire Shared/ExportButton
php artisan make:livewire Shared/NotificationBell



🎨 4. Création des Composants Blade Réutilisables

# Composants UI Génériques
php artisan make:component UI/Card
php artisan make:component UI/Table
php artisan make:component UI/Modal
php artisan make:component UI/StatsCard
php artisan make:component UI/Badge
php artisan make:component UI/Button
php artisan make:component UI/Input
php artisan make:component UI/Select

# Composants Dashboard
php artisan make:component Dashboard/Filters
php artisan make:component Dashboard/KpiCards
php artisan make:component Dashboard/ChartContainer

# Partials
php artisan make:view partials.header
php artisan make:view partials.sidebar
php artisan make:view partials.footer
php artisan make:view partials.scripts