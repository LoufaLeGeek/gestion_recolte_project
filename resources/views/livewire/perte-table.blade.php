<div class="space-y-4">
    <table
        class="w-full table [&_tr]:border-0 [&_td]:border-0 [&_th]:border-0  border-separate border-spacing-y-3 bg-base-100 shadow-sm">
        <thead class="[&_tr]:font-bold [&_tr]:text-base-content">
            <tr>
                <th>Produit</th>
                <th>Nom variete</th>
                <th>Date</th>
                <th>Quantite</th>
                <th>Montant Totale estimer</th>
                <th>Motif</th>
            </tr>
        </thead>
        <tbody class="[&_tr]:text-sm [&_tr]:hover:bg-base-content/10">
            @forelse ($pertes as $perte)
                <tr>
                    <td>
                        <span class="badge bg-green-300/30">{{ $perte->varietee->produit->nom_produit }}</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-error">{{ $perte->varietee->nom_varietee }}</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-base">{{ $perte->get_date_perte() }}</span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-accent">
                            {{ $perte->get_quantite_perdue() }} Kg
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-soft badge-primary">
                            {{ $perte->get_mantant_estimer() }} FCFA
                        </span>
                    </td>
                    <td>{{ $perte->motif }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune valeur trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        {{ $pertes->links() }}
    </div>
</div>
