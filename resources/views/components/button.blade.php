@props([
    "icon" => null,
    "action" => null,
    "phantom" => false,
])

@if ($action) <a href="{{ $action }}"> @endif
<div {{ $attributes->class([
    "button",
    "phantom" => $phantom,
    "padded",
    "rounded",
    "flex",
    "right",
    "center",
    "middle",
]) }}>
    @if ($icon) @svg("mdi-$icon") @endif

    <span class="label">
        {{ $slot }}
    </span>
</div>
@if ($action) </a> @endif
