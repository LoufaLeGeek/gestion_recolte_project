<div class="flex gap-1 justify-center">
    <a href="{{ route('varietees.show', $varietee) }}" class="btn btn-info btn-xs sm:btn-sm gap-1"
        title="Voir détails">
        <i class="fas fa-eye text-xs"></i>
        <span class="hidden xs:inline text-xs">Voir</span>
    </a>
    <a href="{{ route('varietees.edit', $varietee) }}" class="btn btn-warning btn-xs sm:btn-sm gap-1"
        title="Modifier">
        <i class="fas fa-edit text-xs"></i>
        <span class="hidden xs:inline text-xs">Éditer</span>
    </a>
    <form action="{{ route('varietees.destroy', $varietee) }}" method="POST" class="inline"
        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette variété ?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-xs sm:btn-sm gap-1" title="Supprimer">
            <i class="fas fa-trash text-xs"></i>
            <span class="hidden xs:inline text-xs">Supprimer</span>
        </button>
    </form>
</div>
