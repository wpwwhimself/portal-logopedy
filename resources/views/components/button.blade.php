@props([
    "icon" => null,
    "action" => null,
    "phantom" => false,
])

@if ($action == "submit")
<button type="submit" {{ $attributes->only(["name", "value"]) }}>
@elseif ($action)
<a href="{{ $action }}">
@endif

<div {{ $attributes->except(["name", "value"])->class([
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

    @if ($slot->isNotEmpty())
    <span class="label">
        {{ $slot }}
    </span>
    @endif
</div>

@if ($action == "submit") </button> @elseif ($action) </a> @endif
