<nav class="navbar relative bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-600 shadow-xl overflow-hidden">
    <!-- Fond animé -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-300 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-cyan-300 rounded-full blur-3xl animate-pulse animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-teal-400 rounded-full blur-3xl opacity-50 animate-pulse"></div>
    </div>

    <div class="navbar-start relative backdrop-blur-md bg-black bg-opacity-20 px-6 py-4">
        <!-- Logo avec animation -->
        <a href="#" class="btn btn-ghost normal-case text-white font-bold text-2xl flex items-center group transition-all duration-300 px-0">
            <div class="avatar placeholder">
                <div class="bg-emerald-200 text-emerald-800 rounded-full w-10 h-10 flex items-center justify-center group-hover:scale-125 group-hover:rotate-12 transition-transform duration-300">
                    <i class="fas fa-seedling"></i>
                </div>
            </div>
            <span class="bg-gradient-to-r from-emerald-200 via-cyan-100 to-teal-100 bg-clip-text text-transparent font-black tracking-wide ml-3">
                Gestion Production Agricole
            </span>
        </a>
    </div>

    <div class="navbar-end relative backdrop-blur-md bg-black bg-opacity-20 px-6 py-4">
        <!-- Section utilisateur -->
        <div class="flex items-center text-white gap-6">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost hover:bg-transparent text-white flex items-center gap-2">
                    <div class="avatar placeholder">
                        <div class="bg-emerald-300 text-emerald-800 rounded-full w-8 h-8">
                            <span class="text-xs">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                        </div>
                    </div>
                    <span class="text-sm font-semibold tracking-wide opacity-90 hidden md:inline">
                        {{ auth()->user()->name ?? 'Administrateur' }}
                    </span>
                    <i class="fas fa-chevron-down text-xs opacity-70"></i>
                </div>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow-lg bg-base-100 rounded-box w-52 mt-2 z-50">
                    <li><a><i class="fas fa-user me-2"></i>Mon profil</a></li>
                    <li><a><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                    <div class="divider my-1"></div>
                    <li>
                        <a href="#" class="text-red-600 hover:text-red-700 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>