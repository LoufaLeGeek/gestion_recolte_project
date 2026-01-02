@props(['href' => '#', 'content' => '', 'class_icon' => ''])
<a href="{{ $href }}">
    <li>
        <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right hover" data-tip="{{ $content }}">
            <i class="{{ $class_icon }}"></i>
            <span class="is-drawer-close:hidden">{{ $content }}</span>
        </button>
    </li>
</a>
