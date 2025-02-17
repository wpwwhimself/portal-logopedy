@extends("layouts.admin")

@section("title", ($data?->name ?: "Tworzenie")." | ".$meta["label"])
@section("subtitle", "Administracja")

@section("content")

<x-full-width>
    <form action="{{ route('admin-process-edit-model', ['model' => $scope]) }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $data?->id ?? "" }}">

        <x-side-content-container>
            <x-h :icon="$meta['icon']">
                @if ($data)
                {{ $data->name }}: edycja
                @else
                {{ $meta["label"] }}: tworzenie
                @endif
            </x-h>

            @foreach ($fields as $name => $fdata)
            <x-input :type="$fdata['type']"
                :name="$name"
                :label="$fdata['label']"
                :icon="$fdata['icon']"
                :value="$fdata['type'] == 'checkbox' ? 1 : $data?->{$name}"
                :checked="$fdata['type'] == 'checkbox' && $data?->{$name}"
                :options="$fdata['options'] ?? null"
                :required="$fdata['required'] ?? false"
            />
            @endforeach

            @foreach ($connections as $relation => ["model" => $model, "mode" => $mode])
            <input type="hidden" name="_connections[]" value="{{ $relation }}">
            <x-h lvl="2" :icon="$model::META['icon']">{{ $model::META['label'] }}</x-h>

            <div class="grid" style="--col-count: 2;">
                @switch ($mode)
                    @case ("one")
                    <x-input type="select"
                        name="{{ $relation }}"
                        label="Wybierz"
                        :value="$data?->{$relation} ? $data?->{$relation}->id : null"
                        :options="$model::all()->pluck('name', 'id')"
                        empty-option
                    @break

                    @case ("many")
                    @foreach ($model::all() as $item)
                    @if ($relation == "roles" && $item->name == "super" && !auth()->user()->hasRole("super")) @continue @endif
                    <x-input type="checkbox"
                        name="{{ $relation }}[]"
                        :label="$item->name"
                        :hint="$item->description"
                        value="{{ $item->id ?? $item->name }}"
                        :checked="$data?->{$relation}->contains($item)"
                    />
                    @endforeach
                    @break
                @endswitch
            </div>
            @endforeach

            <x-slot:side-content>
                <x-button action="submit" name="method" value="save" icon="check">Zapisz</x-button>
                @if ($data) <x-button action="submit" name="method" value="delete" icon="delete">Usuń</x-button> @endif
                <x-button :action="route('admin-list-model', ['model' => $scope])" icon="arrow-left" class="phantom">Wróć</x-button>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
