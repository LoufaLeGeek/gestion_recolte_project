<!-- Sidebar -->
<div class="w-64 bg-white shadow-md overflow-y-auto">
    <div class="p-4">
        <ul class="space-y-2">
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('dashboard') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-tachometer-alt me-2 text-green-500"></i>Dashboard
                </a>
            </li>
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('produits.*') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-carrot me-2 text-orange-500"></i>Produits & Variétés
                </a>
            </li>
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('recoltes.*') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-seedling me-2 text-brown-500"></i>Récoltes
                </a>
            </li>
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('ventes.*') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-shopping-cart me-2 text-blue-500"></i>Ventes
                </a>
            </li>
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('stocks.*') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-warehouse me-2 text-gray-500"></i>Stocks
                </a>
            </li>
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('rapports.*') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-chart-bar me-2 text-purple-500"></i>Rapports & Statistiques
                </a>
            </li>
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('analyses.*') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-search me-2 text-red-500"></i>Recherches Paramétrées
                </a>
            </li>
            <li>
                <a class="block px-5 py-3 border-l-4 border-transparent hover:bg-green-50 hover:border-green-500 transition {{ request()->routeIs('pertes.*') ? 'bg-green-50 border-green-700 font-semibold' : 'text-gray-700' }}"
                    href="#">
                    <i class="fas fa-exclamation-triangle me-2 text-yellow-500"></i>Pertes & Invendus
                </a>
            </li>
        </ul>
    </div>
</div>
