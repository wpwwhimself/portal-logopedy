@props([
    "src",
    "alt",
    "action" => null,
])

@if ($action) <a href="{{ $action }}"> @endif

<div class="banner full-width">
    <div class="background" style="background-image: url('{{ $src }}');"></div>
    <img src="{{ $src }}" alt="{{ $alt }}">
</div>

@if ($action) </a> @endif
