<div class="stat bg-base-100 rounded-lg p-3 shadow-lg {{ $class ?? '' }}">
    <div class="flex items-center gap-2 mb-1">
        <div>
            <div class="stat-title text-[10px]">{{ $type }}</div>
            <div class="stat-value text-[14px] text-{{ $color ?? 'green' }}-500">{{ $value }}</div>
        </div>
    </div>
    <div class="stat-unite text-xs text-black">
        {{ $unite ?? '' }}
    </div>
    <div class="stat-figure text-{{ $color ?? 'green' }}-500">
        <i class="{{ $icone ?? 'fas fa-leaf' }}"></i>
    </div>
</div>
