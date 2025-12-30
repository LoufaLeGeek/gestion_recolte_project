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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/varietee.auto-dismiss-message.js', 'resources/css/varietee-style.css'])
    <title>@yield('title')</title>
</head>

<body class="bg-base-200">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Navbar -->
            <div class="navbar bg-base-100 shadow-sm z-10 w-full bg-base-100 sticky top-0 border-b border-base-300">
                <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
                    <i class="fa-solid fa-list"></i>
                </label>
                <div class="px-10 flex-1 items-center justify-center space-x-4">
                    <i class="fas fa-seedling text-xl"></i>
                    <h4 class="tracking-wider" style="word-spacing: 4px">Gestion des récoltes</h4>
                </div>
                <div class="flex gap-2">
                    <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS Navbar component"
                                    src="{{ Auth::check() ? Auth::user()->profile : 'https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp' }}" />
                            </div>
                        </div>
                        <ul tabindex="-1"
                            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                            <li>
                                <a class="justify-between">
                                    Profile
                                    <span class="badge">New</span>
                                </a>
                            </li>
                            <li><a>Settings</a></li>
                            <li><a>Logout</a></li>
                        </ul>
                    </div>
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
                <!-- Sidebar content here -->
                <ul class="menu w-full grow gap-1">
                    {{-- List item : Pour ajouter une route dans le href on met -> :href="route('name_route')"  --}}
                    {{-- List item : Pour ajouter une route dans le href on met -> :href="route('name_route')"  --}}
                    <x-menu-item href="" class_icon="fas fa-tachometer-alt" content="Dashboard" />
                    <x-menu-item href="{{ route('produits.index') }}" class_icon="fas fa-carrot text-orange-500" content="Produit" />
                    <x-menu-item href="{{ route('varietees.index') }}" class_icon="fas fa-leaf text-xs"
                        content="Variété" />
                    <x-menu-item href="" class_icon="fas fa-seedling" content="Récoltes" />
                    <x-menu-item :href="route('gestion-vente')" class_icon="fas fa-shopping-cart" content="Ventes" />
                    <x-menu-item href="" class_icon="fa-solid fa-box" content="Stocks" />
                    <x-menu-item href="" class_icon="fa-solid fa-chart-column"
                        content="Rapports & statistique" />
                    <x-menu-item href="" class_icon="fas fa-search" content="Recherche paramétrée" />
                    <x-menu-item href="" class_icon="fas fa-exclamation-triangle" content="Perte et Invendue" />

                </ul>
            </div>
        </div>
    </div>
</body>

</html>
