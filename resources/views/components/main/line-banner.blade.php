@props([
    "backgroundClass" => null,
    "action" => null,
])

@if ($action) <a href="{{ $action }}"> @endif

<x-full-width :class="$backgroundClass">
    <div {{ $attributes->class([
        "line-banner",
        "padded",
    ]) }}>
        {{ $slot }}
    </div>
</x-full-width>

@if ($action) </a> @endif
