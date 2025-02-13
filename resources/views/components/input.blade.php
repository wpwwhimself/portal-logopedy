@props([
    "type" => "text",
    "name",
    "label",
    "value" => null,
    "icon" => null,
    "options" => null, "emptyOption" => false,
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

    <label for="{{ $name }}" class="ghost">{{ $label }}:</label>

    @switch ($type)
        @case ("checkbox")
        <input type="checkbox"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $attributes->only(["required", "autofocus", "disabled", "checked"]) }}
        />
        @break

        @case ("select")
        <select name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->only(["required", "autofocus", "disabled"]) }}
        >
            @if ($emptyOption) <option value="">— brak —</option> @endif
            @foreach ($options as $opt_val => $opt_label)
            <option value="{{ $opt_val }}"
                {{ $opt_val == $value ? "selected" : "" }}
            >
                {{ $opt_label }}
            </option>
            @endforeach
        </select>
        @break

        @case ("TEXT")
        <textarea name="{{ $name }}"
            id="{{ $name }}"
            placeholder="Zacznij pisać..."
            {{ $attributes->only(["required", "autofocus", "disabled"]) }}
        >{{ $value }}</textarea>
        @break

        @case ("HTML")
        <x-ckeditor :name="$name" :value="$value" />
        @break

        @default
        <input type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="— brak —"
            {{ $attributes->only(["required", "autofocus", "disabled", "autocomplete"]) }}
        />
    @endswitch
</div>
