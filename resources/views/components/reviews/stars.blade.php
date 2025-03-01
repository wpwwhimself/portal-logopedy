@props([
    "rating" => null,
    "clickable" => false,
])

<span {{ $attributes->class([
    "clickable" => $clickable,
    "accent", "tertiary",
]) }}>
    @for ($i = 1; $i <= 5; $i++)
    @svg("mdi-star".($i <= $rating
        ? ""
        : ($i - 0.5 <= $rating
            ? "-half-full"
            : "-outline"
        )
    ))
    @endfor
</span>
