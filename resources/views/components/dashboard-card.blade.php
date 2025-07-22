@props(['title', 'value', 'icon', 'bg' => 'primary'])

<div class="col-md-3 mb-3">
    <div class="card text-white bg-{{ $bg }} shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $icon }} {{ $title }}</h5>
            <h3>{{ $value }}</h3>
        </div>
    </div>
</div>
