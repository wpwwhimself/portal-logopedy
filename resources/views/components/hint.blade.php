@props([
    "title" => "Porada",
])

<div {{ $attributes->class(["hint"]) }}>
    <x-h lvl="3" icon="lightbulb">{{ $title }}</x-h>
    {{ $slot }}
</div>
