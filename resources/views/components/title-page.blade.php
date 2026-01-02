@props([
    "title" => "",
    "sub_title" => "",
    "class_icon" => null,
])

<div class="w-fit">
    <div class="flex items-center gap-2">
        <i class="{{ $class_icon }}"></i>
        <h4>{{ $title }}</h4>
    </div>
    <p class="text-[12px]">{{ $sub_title }}</p>
</div>
