@extends("layouts.stripped")

@section("title", $meta["label"])
@section("subtitle", "Administracja")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-model-intro :meta="$meta" />

        @forelse ($data as $item)
        <x-tile :action="route('admin-edit-model', ['model' => $scope, 'id' => $item->id])"
            class="flex right spread middle"
        >
            <x-h lvl="2">{!! $item !!}</x-h>

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

        {{ $data->links() }}

        <x-slot:side-content>
            <x-button :action="route('admin-edit-model', ['model' => $scope])" icon="plus">Dodaj</x-button>
            @foreach ($actions as $action)
            <x-button :action="route($action['route'])" :icon="$action['icon']" class="phantom">{{ $action['label'] }}</x-button>
            @endforeach
            <x-button :action="route('entmgr-list', ['model' => $scope])" icon="eye" class="phantom">Przegląd danych</x-button>
            <x-button :action="route('profile')" icon="arrow-left" class="phantom">Wróć</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
