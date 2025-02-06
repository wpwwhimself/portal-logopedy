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
                :value="$data?->{$name}"
                :options="$fdata['options'] ?? null"
            />
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
