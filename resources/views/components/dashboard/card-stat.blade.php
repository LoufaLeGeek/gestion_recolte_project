<div class="stat bg-base-100 rounded-sm p-4 shadow-sm {{ $class ?? '' }}">
    <div>
        <div class="stat-title text-xs">{{ $type }}</div>
        <div class="stat-value text-lg text-{{ $color ?? 'green' }}-500">{{ $value }}</div>
    </div>
    <div class="stat-unite text-xs text-black">
        {{ $unite ?? '' }}
    </div>
    <div class="stat-figure text-{{ $color ?? 'green' }}-500">
        <i class="{{ $icone ?? 'fas fa-leaf' }}"></i>
    </div>
</div>
