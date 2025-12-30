<div class="stat bg-base-200 rounded-lg p-3">
    <div class="flex items-center gap-2 mb-1">
        <div>
            <div class="stat-title text-xs">{{ $type }}</div>
            <div class="stat-value text-lg">{{ $value }}</div>
        </div>
    </div>
    <div class="stat-desc text-xs">
        {{ $description ?? '' }}
    </div>
    <div class="stat-figure text-{{ $color ?? 'green' }}-500">
        <i class="{{ $icone ?? 'fas fa-leaf' }}"></i>
    </div>
</div>
