<div class="bg-base-100 card card-body shadow-lg col-md-12 {{ $style ?? '' }}">
    <h5 class="mb-3"> <i class="{{ $icone }}"></i> {{ $title }}</h5>

    <div class="chart-container h-80">
        <canvas id="{{ $chartId }}"></canvas>
    </div>
</div>
