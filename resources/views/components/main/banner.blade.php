@props([
    "src",
    "alt",
    "action" => null,
])

@if ($action) <a href="{{ $action }}"> @endif

<div class="banner full-width flex right center middle">
    <img src="{{ $src }}" alt="{{ $alt }}">
</div>

@if ($action) </a> @endif
