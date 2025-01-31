@props([
    "action" => null,
])

@if ($action) <a href="{{ $action }}"> @endif

<div {{ $attributes->class([
    "tile",
    "bordered",
    "rounded",
    "padded",
]) }}>
    {{ $slot }}
</div>

@if ($action) </a> @endif
