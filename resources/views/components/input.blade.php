<div class="flex right middle spread">

<div {{ $attributes->class([
    "input",
    "grid",
    "middle",
    "padded",
    "rounded",
    "animatable",
]) }}>
    @if ($icon) @svg("mdi-$icon") @endif

    <label for="{{ $name }}">
        {!! $label !!}
        @if ($hint) <span {{ Popper::pop($hint) }}>@svg("mdi-information")</span> @endif
        :
    </label>

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

        @case ("JSON")
        <input type="hidden" name="{{ $name }}" value="{{ $value ? json_encode($value) : null }}">
        <table data-name="{{ $name }}" data-columns="{{ count($columnTypes) }}">
            <thead>
                <tr>
                    @foreach (array_keys($columnTypes) as $key)
                    <th>{{ $key }}</th>
                    @endforeach
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($value ?? [] as $key => $val)
                <tr>
                    @php $i = 0; @endphp
                    @switch (count($columnTypes))
                        @case (2)
                        {{-- key-value array --}}
                        @foreach ($columnTypes as $t)
                        <td class="rounded">
                            <input type="{{ $t }}" value="{{ ($i++ == 0) ? $key : $val }}" onchange="JSONInputUpdate('{{ $name }}')" />
                        </td>
                        @endforeach
                        @break

                        @case (1)
                        {{-- simple array --}}
                        <td class="rounded">
                            <input type="{{ current($columnTypes) }}" value="{{ $val }}" onchange="JSONInputUpdate('{{ $name }}')" />
                        </td>
                        @break

                        @default
                        {{-- array of arrays --}}
                        @foreach ($columnTypes as $t)
                        <td class="rounded">
                            <input type="{{ $t }}" value="{{ $val[$i++] }}" onchange="JSONInputUpdate('{{ $name }}')" />
                        </td>
                        @endforeach
                    @endswitch

                    <td><x-button icon="delete" class="phantom interactive" onclick="JSONInputDeleteRow('{{ $name }}', this)" /></td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr role="new-row">
                    @foreach ($columnTypes as $t)
                    <td class="rounded">
                        <input type="{{ $t }}" onchange="JSONInputUpdate('{{ $name }}')"
                            @if ($autofillFrom)
                            onkeyup="JSONInputAutofill('{{ $name }}', event)"
                            @endif
                        />
                        @if ($autofillFrom)
                        <span role="autofill-hint" class="ghost flex right"></span>
                        @endif
                    </td>
                    @endforeach

                    <td>
                        <x-button icon="plus" class="accent background secondary interactive" onclick="JSONInputAddRow('{{ $name }}', this)" />
                        <x-button icon="delete" class="phantom interactive hidden" onclick="JSONInputDeleteRow('{{ $name }}', this)" />
                    </td>
                </tr>
            </tfoot>
        </table>
        @break

        @default
        <input type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $attributes->get("placeholder", "— brak —") }}"
            {{ $attributes->only(["required", "autofocus", "disabled", "autocomplete"]) }}
        />
    @endswitch
</div>

@if ($extraButtons)
<div class="flex right middle">
    @if ($storageFile)
    <x-button icon="folder-open" class="phantom interactive" onclick="browseFiles('{{ route('files-list', ['select' => $name]) }}')" />
    @endif

    @if ($value)
    <x-button :action="$value" icon="open-in-new" class="accent background secondary" target="_blank" />
    @endif
</div>
@endif

</div>

@if ($autofillFrom)
<script>
window.autofill = window.autofill ?? {}
fetch("{{ $autofillRoute }}").then(res => res.json()).then(data => {
    window.autofill['{{ $name }}'] = data
})
</script>
@endif
