@props([
    "action" => null,
    "title" => null,
    "titleIcon" => null,
    "noBorder" => false,
])

@if ($action) <a href="{{ $action }}"> @endif

<div {{ $attributes->class([
    "tile",
    "bordered" => !$noBorder,
    "rounded",
    "padded",
    "interactive" => $action, "highlight",
]) }}>
    @if ($title)
    <x-h lvl="2" :icon="$titleIcon">{{ $title }}</x-h>
    @endif

    {{ $slot }}
</div>

@if ($action) </a> @endif
