@extends("layouts.admin")

@section("title", $meta["label"])
@section("subtitle", "Administracja")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="$meta['icon']">{{ $meta["label"] }}</x-h>

        @forelse ($data as $item)
        <x-tile :action="route('admin-edit-model', ['model' => $scope, 'id' => $item->id])"
            class="flex right spread middle"
        >
            <x-h lvl="2" :icon="$meta['icon']">{{ $item->name }}</x-h>

            <div class="flex down">
                @isset ($item->visible)
                <small>
                    @svg("mdi-eye")
                    {{ App\Http\Controllers\AdminController::VISIBILITIES[$item->visible] }}
                </small>
                @endisset
            </div>
        </x-tile>
        @empty
        <div class="ghost">Brak danych do wyświetlenia</div>
        @endforelse

        <x-slot:side-content>
            <x-button :action="route('admin-edit-model', ['model' => $scope])" icon="plus">Dodaj</x-button>
            <x-button :action="route('profile')" icon="arrow-left" class="phantom">Wróć</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
