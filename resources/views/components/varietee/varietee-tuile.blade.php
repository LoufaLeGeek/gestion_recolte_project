<tr class="hover:bg-base-100 transition-colors">


    <td class="text-xs sm:text-sm py-2">#{{ $varietee->id }}</td>


    <td class="py-2">
        <x-varietee.varietee-nom :varietee="$varietee" />
    </td>


    <td class="py-2">
        <x-varietee.varietee-nomProduit-column :varietee="$varietee" />
    </td>


    <td class="py-2">
        <x-varietee.varietee-prix-column :varietee="$varietee" />
    </td>


    <td class="py-2">
        <div class="max-w-[150px] sm:max-w-xs">
            <span class="truncate-2-lines text-xs sm:text-sm">
                {{ $varietee->caracteristique_varietee }}
            </span>
        </div>
    </td>


    <td class="py-2">
        <div class="text-xs">
            <div>{{ $varietee->created_at->format('d/m/Y') }}</div>
            <div class="text-gray-500">{{ $varietee->created_at->format('H:i') }}</div>
        </div>
    </td>


    <td class="py-2">
        <x-varietee.varietee-actions-column :varietee="$varietee" />
    </td>
</tr>
