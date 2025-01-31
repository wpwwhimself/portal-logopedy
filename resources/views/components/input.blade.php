@props([
    "type" => "text",
    "name",
    "label",
    "value" => null,
    "icon" => null,
])

<div {{ $attributes->class([
    "input",
    "grid",
    "middle",
    "padded",
    "rounded",
    "animatable",
]) }}>
    @if ($icon) @svg("mdi-$icon") @endif

    @if ($type == "checkbox")
    <span>
        <label for="{{ $name }}">{{ $label }}</label>
        <input type="checkbox"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $attributes->only(["required", "autofocus", "disabled", "checked"]) }}
        />
    </span>
    @else
    <input type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $label }}"
        {{ $attributes->only(["required", "autofocus", "disabled"]) }}
    />
    @endif
</div>
