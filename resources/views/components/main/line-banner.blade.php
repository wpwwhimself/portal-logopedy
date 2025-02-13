@props([
    "backgroundClass" => null,
    "backgroundStyle" => null,
    "action" => null,
])

@if ($action) <a href="{{ $action }}"> @endif

<x-full-width :class="$backgroundClass" :style="$backgroundStyle">
    <div {{ $attributes->class([
        "line-banner",
        "padded",
    ]) }}>
        {{ $slot }}
    </div>
</x-full-width>

@if ($action) </a> @endif
