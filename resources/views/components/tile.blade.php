@props([
    "action" => null,
    "title" => null,
    "titleIcon" => null,
])

@if ($action) <a href="{{ $action }}"> @endif

<div {{ $attributes->class([
    "tile",
    "bordered",
    "rounded",
    "padded",
]) }}>
    @if ($title)
    <x-h lvl="2" :icon="$titleIcon">{{ $title }}</x-h>
    @endif

    {{ $slot }}
</div>

@if ($action) </a> @endif
