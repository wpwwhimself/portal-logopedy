@props([
    "icon" => null,
    "action" => null,
    "phantom" => false,
])

@if ($action == "submit")
<button type="submit"
@elseif ($action)
<a href="{{ $action }}"
@else
<div
@endif

{{ $attributes->except(["name", "value", "target"])->class([
    "button",
    "phantom" => $phantom,
    "padded",
    "rounded",
    "flex",
    "right",
    "center",
    "middle",
    "interactive" => $action, "highlight",
]) }}>
    @if ($icon) @svg("mdi-$icon") @endif

    @if ($slot->isNotEmpty())
    <span class="label">
        {{ $slot }}
    </span>
    @endif

@if ($action == "submit") </button> @elseif ($action) </a> @else </div> @endif
