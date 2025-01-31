@props([
    "type" => "text",
    "name",
    "label",
    "value" => null,
    "icon" => null,
])

<x-tile class="flex right middle tertiary">
    @if ($icon) @svg("mdi-$icon") @endif
</x-tile>
