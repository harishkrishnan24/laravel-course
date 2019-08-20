@if (!isset($show) || $show)
    <span class="badge badge-success">
    {{ $slot }}
    </span>
@endif
