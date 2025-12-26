<!-- Sidebar Artistique -->
<div
    class="w-64 bg-gradient-to-b from-green-100 via-white to-green-50 shadow-2xl overflow-y-auto border-r-2 border-green-200 scrollbar-thin scrollbar-thumb-green-400 scrollbar-track-green-100">
    <div class="p-6">
        <!-- Header Décoratif -->
        <div class="mb-8 pb-6 border-b-2 border-green-200">
            <div class="text-center">
                <i class="fas fa-leaf text-3xl text-green-600 animate-bounce"></i>
                <h2 class="text-lg font-bold text-green-700 mt-2">Gestion Récolte</h2>
            </div>
        </div>

        <ul class="space-y-3">
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-green-50 hover:to-transparent hover:border-black transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-green-100 to-transparent border-green-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-tachometer-alt me-3 text-black group-hover:scale-110 transition"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-orange-50 hover:to-transparent hover:border-orange-500 transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('produits.*') ? 'bg-gradient-to-r from-orange-100 to-transparent border-orange-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-carrot me-3 text-orange-500 group-hover:scale-110 transition"></i>
                    <span class="font-medium">Produits & Variétés</span>
                </a>
            </li>
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-amber-50 hover:to-transparent hover:border-amber-600 transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('recoltes.*') ? 'bg-gradient-to-r from-amber-100 to-transparent border-amber-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-seedling me-3 text-amber-600 group-hover:scale-110 transition"></i>
                    <span class="font-medium">Récoltes</span>
                </a>
            </li>
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent hover:border-blue-500 transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('ventes.*') ? 'bg-gradient-to-r from-blue-100 to-transparent border-blue-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-shopping-cart me-3 text-blue-500 group-hover:scale-110 transition"></i>
                    <span class="font-medium">Ventes</span>
                </a>
            </li>
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-gray-50 hover:to-transparent hover:border-gray-500 transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('stocks.*') ? 'bg-gradient-to-r from-gray-100 to-transparent border-gray-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-warehouse me-3 text-gray-500 group-hover:scale-110 transition"></i>
                    <span class="font-medium">Stocks</span>
                </a>
            </li>
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-purple-50 hover:to-transparent hover:border-purple-500 transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('rapports.*') ? 'bg-gradient-to-r from-purple-100 to-transparent border-purple-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-chart-bar me-3 text-purple-500 group-hover:scale-110 transition"></i>
                    <span class="font-medium">Rapports & Statistiques</span>
                </a>
            </li>
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent hover:border-red-500 transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('analyses.*') ? 'bg-gradient-to-r from-red-100 to-transparent border-red-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-search me-3 text-red-500 group-hover:scale-110 transition"></i>
                    <span class="font-medium">Recherches Paramétrées</span>
                </a>
            </li>
            <li>
                <a class="group block px-5 py-1 border-l-4 border-transparent hover:bg-gradient-to-r hover:from-yellow-50 hover:to-transparent hover:border-yellow-500 transition duration-300 ease-out transform hover:translate-x-1 {{ request()->routeIs('pertes.*') ? 'bg-gradient-to-r from-yellow-100 to-transparent border-yellow-700 font-semibold shadow-md' : 'text-gray-600' }}"
                    href="#">
                    <i class="fas fa-exclamation-triangle me-3 text-yellow-500 group-hover:scale-110 transition"></i>
                    <span class="font-medium">Pertes & Invendus</span>
                </a>
            </li>
        </ul>
    </div>
</div>
