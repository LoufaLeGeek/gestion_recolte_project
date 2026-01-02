<div class="bg-base-100 rounded-sm shadow-smp-4 w-full min-w-0 max-w-full p-4 space-y-4">
    <div class="flex items-center gap-2">
        <i class="{{ $icone }}"></i>
        <p>
            {{ $title }}
        </p>
    </div>
    <div class="chart-container h-60">
        <canvas id="{{ $chartId }}"></canvas>
    </div>
</div>
