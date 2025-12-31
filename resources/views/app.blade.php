<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body class="bg-base-200">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Navbar -->
            <nav class="navbar z-5 w-full bg-base-100 sticky top-0 border-b border-base-300">
                <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
                    <i class="fa-solid fa-list"></i>
                </label>
                <div class="px-10 flex items-center justify-center space-x-4">
                    <i class="fas fa-seedling text-xl"></i>
                    <h4 class="tracking-wider" style="word-spacing: 4px">Gestion des récoltes</h4>
                </div>
            </nav>

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
                <!-- Sidebar content here -->
                <ul class="menu w-full grow gap-1">
                    {{-- List item : Pour ajouter une route dans le href on met -> :href="route('name_route')"  --}}
                    <x-menu-item href="" class_icon="fas fa-tachometer-alt" content="Dashboard" />
                    <x-menu-item href="" class_icon="fas fa-carrot" content="Produit & Variété" />
                    <x-menu-item :href="route('recoltes.index')" class_icon="fas fa-seedling" content="Récoltes" />
                    <x-menu-item href="" class_icon="fas fa-shopping-cart" content="Ventes" />
                    <x-menu-item href="" class_icon="fa-solid fa-box" content="Stocks" />
                    <x-menu-item href="" class_icon="fa-solid fa-chart-column"
                        content="Rapports & statistique" />
                    <x-menu-item href="" class_icon="fas fa-search" content="Recherche paramétrée" />
                    <x-menu-item href="" class_icon="fas fa-exclamation-triangle" content="Perte et Invendue" />

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
