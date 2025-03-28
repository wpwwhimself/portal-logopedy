@extends ("layouts.barren")

@section("title", $meta["label"])
@section("subtitle", "Zarządzanie modelami")

@section("content")

<table class="tight scrollable">
    <thead>
        <tr>
            <th>Nazwa</th>
            @foreach ($modelName::FIELDS as $field)
            @isset ($field["hide-for-entmgr"]) @continue @endisset
            <th>{{ $field["label"] }}</th>
            @endforeach
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>
                <strong>{{ $row->name }}</strong>
                <br>
                @isset ($row->visible)
                <span>
                    <x-icon name="eye" hint="Widoczność" />
                    {{ App\Http\Controllers\AdminController::VISIBILITIES[$row->visible] }}
                </span>
                @endisset
            </td>
            @foreach ($modelName::FIELDS as $field_name => $field)
            @isset ($field["hide-for-entmgr"]) @continue @endisset
            <td>
                @if ($field["type"] == "JSON")
                <ul>
                    {!! $row->{$field_name}
                        ?->map(fn ($i) => (current($field["column-types"]) == "url")
                            ? "<li><a href=\"{$i}\" target=\"_blank\">{$i}</a></li>"
                            : "<li>{$i}</li>"
                        )
                        ->join("\n")
                    !!}

                </ul>
                @else
                {{ Str::of($row->{$field_name})->stripTags()->words(25) }}
                @endif
            </td>
            @endforeach
            <td>
                <x-button icon="pencil" class="small" :action="route('admin-edit-model', ['model' => Str::of($modelName)->afterLast('\\')->plural()->kebab()->toString(), 'id' => $row->id])" target="_blank">Edytuj</x-button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
