<nav class="bg-green-700 shadow-md">
    <div class="flex-1 px-4 py-3 flex justify-between items-center">
        <a href="#" class="text-white font-bold text-lg flex items-center">
            <i class="fas fa-seedling me-2"></i>Gestion Production Agricole
        </a>
        <div class="flex items-center text-white gap-3">
            <span>{{ auth()->user()->name ?? 'Administrateur' }}</span>
            <a href="#" class="border border-white px-3 py-1 rounded text-sm hover:bg-green-600">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
</nav>