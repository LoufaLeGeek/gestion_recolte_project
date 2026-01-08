@props([
    'text_color' => '',
    'value' => 0,
    'text_content' => '',
])

<div class="bg-base-100 flex-1 p-1 flex flex-col justify-center items-center shadow-lg hover:scale-[1.05] hover:bg-base-300/90  duration-200">
    <h3 class="{{ $text_color }} text-center">{{ $value }} {{ $slot }}</h3>
    <span class="font-semibold text-[12px] text-center ">{{ $text_content }}</span>
</div>
