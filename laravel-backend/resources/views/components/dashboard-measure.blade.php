<div class="card shadow">
    <div class="card-body d-flex flex-row">
        <div class="align-self-center ps-3 pe-4">
            <i class="{{ $icon }} display-6 text-primary-emphasis"></i>
        </div>
        <div>
            <h3>{{ $value }}{{ $unit }}</h3>
            <span class="small">{{ $slot }}</span>
        </div>
    </div>
</div>
