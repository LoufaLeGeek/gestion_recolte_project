<div class="space-y-4">
    <table
        class="w-full table [&_tr]:border-0 [&_td]:border-0 [&_th]:border-0  border-separate border-spacing-y-3 bg-base-100 shadow-sm">
        <thead class="[&_tr]:font-bold [&_tr]:text-base-content">
            <tr>
                <th>Id</th>
                <th>Produit</th>
                <th>Nom variete</th>
                <th>Date</th>
                <th>Quantite</th>
                <th>Prix Unitaire</th>
                <th>Prix Totale</th>
            </tr>
        </thead>
        <tbody class="[&_tr]:text-sm [&_tr]:hover:bg-base-content/10">
            @foreach ($ventes as $vente)
                <tr>
                    <td>
                        <span>#{{ $vente->id }}</span>
                    </td>
                    <td>
                        <span class="badge bg-green-300/30">{{ $vente->varietee->produit->nom_produit }}</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-error">{{ $vente->varietee->nom_varietee }}</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-base">{{ $vente->get_date() }}</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-accent">{{ $vente->get_quantite() }} Kg</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-primary">{{ $vente->get_prix() }} FCFA</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-secondary ">{{ $vente->get_montant() }} FCFA</span>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $ventes->links() }}
</div>
