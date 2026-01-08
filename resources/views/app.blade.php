<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>@yield('title') - SyGRA</title>
</head>

<body class="bg-base-200">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Navbar -->
            <div class="navbar bg-base-100 shadow-sm z-10 w-full sticky top-0 border-b border-base-300">
                <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
                    <i class="fa-solid fa-list"></i>
                </label>
                <div class="px-10 flex-1 items-center justify-center space-x-4">
                    <h2 style="font-family: poppins; word-spacing: 4px;"><i
                            class="fas fa-seedling text-xl mr-3 text-green-500"></i>SyGRA</h2>
                    <h8 class="tracking-wider">Systeme de Gestion des Ressources Agricoles</h8>
                </div>
            </div>
            <!-- CONTENUE DU PAGE -->
            <div class="p-4">

                @yield('content')
            </div>
        </div>

        <div class="drawer-side is-drawer-close:overflow-visible">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div
                class="flex min-h-full flex-col items-start
            bg-base-100 border-r border-base-300  is-drawer-close:w-14 is-drawer-open:w-64">
                <div
                    class="flex min-h-full flex-col items-start bg-base-100 border-r border-base-300 is-drawer-close:w-14 is-drawer-open:w-64">
                    <!-- Sidebar content here -->
                    <ul class="menu w-full grow gap-1">
                        {{-- List item : Pour ajouter une route dans le href on met -> :href="route('name_route')"  --}}
                        {{-- List item : Pour ajouter une route dans le href on met -> :href="route('name_route')"  --}}
                        <x-menu-item href="{{ route('dashboard') }}"
                            class_icon="fas fa-tachometer-alt text-base-neutral" content="Dashboard" />
                        <x-menu-item href="{{ route('produits.index') }}" class_icon="fas fa-carrot text-orange-500"
                            content="Produit" />
                        <x-menu-item href="{{ route('varietees.index') }}" class_icon="fas fa-leaf text-green-500"
                            content="Variété" />

                        <x-menu-item href="{{ route('recoltes.index') }}" class_icon="fas fa-seedling text-yellow-500"
                            content="Récoltes" />
                        <x-menu-item :href="route('gestion-vente')" class_icon="fas fa-shopping-cart text-red-900"
                            content="Ventes" />
                        <x-menu-item :href="route('gestion-stock')" class_icon="fa-solid fa-box text-primary" content="Stocks" />
                        <x-menu-item :href="route('gestion-perte')" class_icon="fas fa-exclamation-triangle text-orange-300"
                            content="Perte et Invendue" />

                        <x-menu-item href="" class_icon="fa-solid fa-chart-column"
                            content="Rapports & statistique" />
                        <x-menu-item href="" class_icon="fas fa-search" content="Recherche paramétrée" />


                        {{-- A faire a la fin du projet --}}
                        <div class="flex-none absolute bottom-2">
                            <a href="">
                                <li>
                                    <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                                        data-tip="Ma profile">
                                        <i class="fas fa-user"></i>
                                        <span class="is-drawer-close:hidden">Ma profile</span>
                                    </button>
                                </li>
                            </a>
                            <a href="">
                                <li>
                                    <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                                        data-tip="Se déconnecter">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span class="is-drawer-close:hidden">Se déconnecter</span>
                                    </button>
                                </li>
                            </a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
</body>

</html>
