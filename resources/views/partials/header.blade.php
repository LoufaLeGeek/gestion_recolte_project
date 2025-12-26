<nav class="relative bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-600 shadow-xl overflow-hidden">
    <!-- Fond animé -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-300 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-cyan-300 rounded-full blur-3xl animate-pulse animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-teal-400 rounded-full blur-3xl opacity-50 animate-pulse"></div>
    </div>

    <div class="relative flex-1 px-6 py-4 flex justify-between items-center backdrop-blur-md bg-black bg-opacity-20">
        <!-- Logo avec animation -->
        <a href="#" class="text-white font-bold text-2xl flex items-center group cursor-pointer transition-all duration-300">
            <i class="fas fa-seedling me-3 text-emerald-200 text-2xl group-hover:scale-125 group-hover:rotate-12 transition-transform duration-300"></i>
            <span class="bg-gradient-to-r from-emerald-200 via-cyan-100 to-teal-100 bg-clip-text text-transparent font-black tracking-wide">
                Gestion Production Agricole
            </span>
        </a>

        <!-- Section utilisateur -->
        <div class="flex items-center text-white gap-6">
            <span class="text-sm font-semibold tracking-wide opacity-90 hover:opacity-100 transition-opacity">
                {{ auth()->user()->name ?? 'Administrateur' }}
            </span>
            <a href="#" class="relative group px-4 py-2 rounded-lg text-sm font-semibold overflow-hidden transition-all duration-300 hover:scale-105">
                <!-- Fond avec effet -->
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-300 to-cyan-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center gap-2">
                    <i class="fas fa-sign-out-alt text-emerald-200 group-hover:text-emerald-900 transition-colors"></i>
                    <span class="hidden sm:inline">Déconnexion</span>
                </div>
            </a>
        </div>
    </div>
</nav>