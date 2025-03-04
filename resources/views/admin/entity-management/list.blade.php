@extends ("layouts.stripped")

@section("title", $meta["label"])
@section("subtitle", "Zarządzanie modelami")

@section("content")

<table class="scrollable">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th><x-icon name="eye" hint="Widoczność" /></th>
            @foreach ($modelName::FIELDS as $field)
            <th>{{ $field["label"] }}</th>
            @endforeach
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td><strong>{{ $row->name }}</strong></td>
            <td>
                @isset ($row->visible)
                {{ App\Http\Controllers\AdminController::VISIBILITIES[$row->visible] }}
                @endisset
            </td>
            @foreach ($modelName::FIELDS as $field_name => $field)
            <td>
                @if ($field["type"] == "JSON")
                <ul>
                    {!! $row->{$field_name}?->map(fn ($i) => "<li>{$i}</li>")->join("\n") !!}

                </ul>
                @else
                {{ Str::of($row->{$field_name})->stripTags()->words(25) }}
                @endif
            </td>
            @endforeach
            <td>
                <x-button icon="pencil" class="small" :action="route('admin-edit-model', ['model' => Str::of($modelName)->afterLast('\\')->kebab()->toString(), 'id' => $row->id])" target="_blank">Edytuj</x-button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
