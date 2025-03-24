@extends("layouts.main")

@section("title", \App\Models\Film::META['label'])

@section("content")

<x-full-width>
    <x-side-content-container flipped>
        <div class="grid col2 middle">
            <x-search-bar placeholder="Wyszukaj" model="films" />
            <strong style="text-align: right;">Wyników: {{ $data->total() }}</strong>
        </div>

        @forelse ($data as $item)
        <x-model-tile.film :data="$item" />
        @empty
        <p class="ghost">Brak danych do wyświetlenia</p>
        @endforelse

        {{ $data->links() }}

        <x-slot:side-content>
            <x-main.filters model-name="films" />
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
