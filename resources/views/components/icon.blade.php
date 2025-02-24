@props([
    "name",
    "hint" => null,
])

<i {{ $hint ? Popper::pop($hint) : "" }} {{ $attributes }}>
    @svg("mdi-$name")
</i>
