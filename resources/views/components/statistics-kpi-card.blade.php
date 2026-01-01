@props([
    'text_color' => '',
    'value' => 0,
    'text_content' => '',
])

<div class="bg-base-100 flex-1 h-full flex flex-col justify-center items-center shadow-xs hover:scale-[1.05] hover:bg-base-300/90  duration-200">
    <h1 class="{{ $text_color }} text-center">{{ $value }} {{ $slot }}</h1>
    <span class="font-semibold text-[12px] ">{{ $text_content }}</span>
</div>
