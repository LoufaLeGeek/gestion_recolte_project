@props([
    'text_color' => '',
    'value' => 0,
    'text_content' => '',
])

<div class="stat bg-base-100 rounded-sm p-4 shadow-sm hover:scale-[1.05] hover:bg-base-300/90 duration-200 flex items-center justify-between">
    <div class="flex flex-col">
        <div class="stat-title text-xs">{{ $text_content }}</div>
        <div class="stat-value text-lg {{ $text_color }}">
            {{ $value }} {{ $slot }}
        </div>
    </div>
    <div class="stat-figure {{ $text_color }}">
        <i class="fas fa-leaf"></i>
    </div>
</div>