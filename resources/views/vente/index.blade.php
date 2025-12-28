@extends('app')
@section('title', 'Vente')
@section('content')
    <div class="space-y-8">

        {{-- btn ajouter une vente --}}
        <div class="w-full flex justify-end">
            <button class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Ajouter une vente
            </button>
        </div>

        {{-- statisques table --}}
        <div class="w-5/6 flex items-center justify-around h-40 rounded-sm gap-4 mx-auto">
            <div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center">
                statistique-1
            </div>
            <div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center">
                statistique-2
            </div>
            <div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center">
                statistique-3
            </div>
        </div>

        {{-- title table --}}
        <div class="space-y-4">
            <div>
                <h4 class="font-bold">Liste de tous les ventes</h4>
                <p class="text-sm text-base-content">Double cliquer sur une ligne pour voir les infos en detaille</p>
            </div>

            {{-- table vente --}}
            <table
                class="w-full table [&_tr]:border-0 [&_td]:border-0 [&_th]:border-0  border-separate border-spacing-y-3 bg-base-100 shadow-sm">
                <thead class="[&_tr]:font-bold [&_tr]:text-base-content">
                    <tr>
                        <th>Produit</th>
                        <th>Nom variete</th>
                        <th>Date</th>
                        <th>Quantite</th>
                        <th>Prix Unitaire</th>
                        <th>Prix Totale</th>
                    </tr>
                </thead>
                <tbody class="[&_tr]:text-sm [&_tr]:hover:bg-base-content/10">
                    <tr>
                        <td>Riz</td>
                        <td class="font-bold">Riz Sahel 108</td>
                        <td>
                            <span class="badge badge-soft badge-base">2025-01-05</span>
                        </td>
                        <td>
                            <span class="badge badge-soft badge-accent">120 kg</span>
                        </td>
                        <td>
                            <span class="badge badge-soft badge-primary">450 FCFA</span>
                        </td>
                        <td>
                            <span class="badge badge-soft badge-secondary ">54 000 FCFA</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Maïs</td>
                        <td>Maïs Jaune Local</td>
                        <td>2025-01-08</td>
                        <td>80 kg</td>
                        <td>300 FCFA</td>
                        <td>24 000 FCFA</td>
                    </tr>
                    <tr>
                        <td>Arachide</td>
                        <td>Arachide Fleur 11</td>
                        <td>2025-01-10</td>
                        <td>60 kg</td>
                        <td>600 FCFA</td>
                        <td>36 000 FCFA</td>
                    </tr>
                    <tr>
                        <td>Mil</td>
                        <td>Mil Souna</td>
                        <td>2025-01-12</td>
                        <td>100 kg</td>
                        <td>350 FCFA</td>
                        <td>35 000 FCFA</td>
                    </tr>
                    <tr>
                        <td>Sorgho</td>
                        <td>Sorgho Rouge</td>
                        <td>2025-01-14</td>
                        <td>90 kg</td>
                        <td>320 FCFA</td>
                        <td>28 800 FCFA</td>
                    </tr>
                    <tr>
                        <td>Oignon</td>
                        <td>Violet de Galmi</td>
                        <td>2025-01-16</td>
                        <td>50 kg</td>
                        <td>700 FCFA</td>
                        <td>35 000 FCFA</td>
                    </tr>
                    <tr>
                        <td>Pomme de terre</td>
                        <td>Spunta</td>
                        <td>2025-01-18</td>
                        <td>75 kg</td>
                        <td>500 FCFA</td>
                        <td>37 500 FCFA</td>
                    </tr>
                    <tr>
                        <td>Tomate</td>
                        <td>Roma VF</td>
                        <td>2025-01-20</td>
                        <td>40 kg</td>
                        <td>800 FCFA</td>
                        <td>32 000 FCFA</td>
                    </tr>
                    <tr>
                        <td>Niébé</td>
                        <td>Niébé Mélakh</td>
                        <td>2025-01-22</td>
                        <td>55 kg</td>
                        <td>650 FCFA</td>
                        <td>35 750 FCFA</td>
                    </tr>
                    <tr>
                        <td>Fonio</td>
                        <td>Fonio Blanc</td>
                        <td>2025-01-25</td>
                        <td>30 kg</td>
                        <td>1 000 FCFA</td>
                        <td>30 000 FCFA</td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- Overlay --}}
        <div class="inset-0  backdrop-blur-[0.8px] fixed bg-base-100/10 z-1000 hidden">
            {{-- content Overlay --}}
            <div
                class="bg-base-100 w-120 rounded-lg p-4 border border-base-300 space-y-4 absolute right-4 top-40 shadow-sm">
                {{-- Head Overlay --}}
                <div class="flex items-center justify-between">
                    <div class="flex gap-4 items-center">
                        <i class="fa-solid fa-plus"></i>
                        <p>Ajouter une vente</p>
                    </div>
                    <div
                        class=" bg-error text-error-content rounded-full w-6 h-6 flex items-center justify-center hover:scale-[1.2] duration-200">
                        <i class="fa-solid fa-x text-[10px]"></i>
                    </div>
                </div>
                {{-- Form content --}}
                <form class="space-y-4">
                    {{-- Select input --}}
                    <div>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Selectionner la varietee</legend>
                            <select class="select outline-none w-full">
                                <option disabled selected>Nom de la varietee</option>
                                <option>Chou rouge</option>
                                <option>Chou vert</option>
                                <option>Riz blanc</option>
                            </select>
                        </fieldset>
                    </div>
                    {{-- simple input --}}
                    <div>
                        <input type="text" placeholder="Prix en kg: 1.90" class="input w-full outline-none" />
                    </div>
                    {{-- btn --}}
                    <div class="space-x-8">
                        <button class="btn bg-green-500 text-base-content w-40">Ajouter</button>
                        <button class="btn bg-error text-error-content w-40">Effacer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
