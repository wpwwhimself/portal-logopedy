@props([
    "action" => null,
    "title" => null,
    "titleIcon" => null,
    "titleLvl" => 2,
    "noBorder" => false,
    "lineSeparated" => false,
    "expandable" => false,
    "backgroundClass" => null,
    "activated" => false,
])

@if ($expandable) @php
$expandable_uuid = uniqid();
@endphp @endif

@if ($action) <a href="{{ $action }}" class="{{ $lineSeparated ? 'line-separated' : '' }}"> @endif

<div @if ($expandable) data-expandable="{{ $expandable_uuid }}" @endif
    class="{{ implode(" ", array_filter([
        "tile",
        !$noBorder ? "bordered" : null,
        "rounded",
        "padded",
        $action ? "interactive" : null,
        "highlight",
        $activated ? "activated" : null,
    ])) }} {{ $backgroundClass }}"
>
    @if ($title)
    <div class="title-bar flex right spread">
        <x-h :lvl="$titleLvl" :icon="$titleIcon">{{ $title }}</x-h>

        @if ($expandable)
        <x-button icon="chevron-down" class="expand-btn phantom interactive small" onclick="expandTile('{{ $expandable_uuid }}')" />
        @endif
    </div>
    @endif

    <div {{ $attributes->class([
        "contents",
        "hidden" => $expandable,
    ]) }}>
        {{ $slot }}
    </div>
</div>

@if ($action) </a> @endif
