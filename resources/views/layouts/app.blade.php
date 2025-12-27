<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Gestion Production Agricole</title>
    
    <!-- Tailwind CSS avec DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* Animation pour le délai */
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        /* Personnalisation des couleurs DaisyUI si nécessaire */
        :root {
            --rounded-box: 1rem;
            --rounded-btn: 0.5rem;
            --rounded-badge: 1.9rem;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-base-100 font-sans h-screen overflow-hidden flex flex-col">
    <!-- Navigation -->
            <!-- Bouton pour ouvrir le drawer sur mobile -->
        <div class="lg:hidden">
            <label for="my-drawer" class="btn btn-circle btn-ghost fixed top-4 left-4 z-50">
                <i class="fas fa-bars text-xl"></i>
            </label>
        </div>
    @include('partials.header')

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar (responsive avec drawer) -->
        <div class="hidden lg:block">
            @include('partials.sidebar')
        </div>



        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4 lg:p-6">
            <!-- Messages de session avec DaisyUI alerts -->
            @if(session('success'))
                <div class="alert alert-success mb-4 shadow-lg">
                    <div>
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button class="btn btn-sm btn-ghost" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error mb-4 shadow-lg">
                    <div>
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button class="btn btn-sm btn-ghost" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        <!-- Header Décoratif -->
        <div class="mb-8 pb-6 border-b-2 border-green-200">
            <div class="text-center">
                <div class="avatar placeholder">
                    <div class="bg-green-100 text-green-600 rounded-full w-12 h-12 flex items-center justify-center">
                        <i class="fas fa-leaf text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-lg font-bold text-green-700 mt-2">Gestion Récolte</h2>
            </div>
        </div>
            <!-- Breadcrumb -->
            <style>
                .breadcrumbs > ul > li { display: flex; align-items: center; }
            </style>
            <div class="text-sm breadcrumbs mb-6">
                <ul class="flex items-center gap-2 w-full">
                    <li><a href="/" class="flex items-center p-0 m-0 gap-2"><i class="fas fa-home"></i> <span>Accueil</span></a></li>
                    @yield('breadcrumb')
                </ul>
            </div>

            <!-- Contenu principal -->
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Drawer pour mobile -->
    <div class="drawer lg:hidden">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="menu p-4 w-80 min-h-full bg-base-100">
                <!-- Contenu du sidebar pour mobile -->
                @include('partials.sidebar')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>