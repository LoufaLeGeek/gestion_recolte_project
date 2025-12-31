<div class="space-y-4">
    <table
        class="w-full table [&_tr]:border-0 [&_td]:border-0 [&_th]:border-0  border-separate border-spacing-y-3 bg-base-100 shadow-sm">
        <thead class="[&_tr]:font-bold [&_tr]:text-base-content">
            <tr>
                <th>Produit</th>
                <th>Nom variete</th>
                <th>Date</th>
                <th>Stoks</th>
            </tr>
        </thead>
        <tbody class="[&_tr]:text-sm [&_tr]:hover:bg-base-content/10">
            @foreach ($varietees as $varietee)
                <tr>
                    <td><span class="badge bg-green-300/30">{{ $varietee->produit->nom_produit }}</span></td>
                    <td><span class="badge badge-soft badge-error">{{ $varietee->nom_varietee }}</span></td>
                    <td>
                        @if ($varietee->stock)
                            <span class="badge badge-soft badge-base">{{ $varietee->stock?->get_update_date() }}
                            </span>
                        @else
                            <span class="badge bg-red-400 text-error-content">
                                <i class="fa-solid fa-times"></i> Stock indisponible</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $quantite = $varietee->stock?->quantite_actuelle ?? null;
                        @endphp
                        @if ($quantite > 0)
                            <span class="badge badge-soft badge-primary">{{ $quantite }}
                                Kg
                            </span>
                        @elseif ($quantite === 0)
                            <span class="badge badge-soft badge-error text-error-content">Epuise</span>
                        @else
                            <span class="badge bg-red-400 text-error-content">
                                <i class="fa-solid fa-times"></i> Stock indisponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $varietees->links() }}
    </div>
</div>
