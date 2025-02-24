@props([
    "rating" => null,
    "clickable" => false,
])

<span {{ $attributes->class([
    "clickable" => $clickable,
]) }}>
    @for ($i = 1; $i <= 5; $i++)
    @svg("mdi-star".($i <= $rating ? "" : "-outline"))
    @endfor
</span>
