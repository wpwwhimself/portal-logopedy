@extends("layouts.main")

@section("title", \App\Models\University::META['label'])

@section("content")

<x-full-width>
    <x-side-content-container flipped>
        <div class="grid col2 middle">
            <x-search-bar placeholder="Wyszukaj" model="universities" />
            <strong style="text-align: right;">Wyników: {{ $data->total() }}</strong>
        </div>

        @forelse ($data as $item)
        <x-model-tile.university :data="$item" />
        @empty
        <p class="ghost">Brak danych do wyświetlenia</p>
        @endforelse

        {{ $data->links() }}

        <x-slot:side-content>
            <x-main.filters model-name="universities" />
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
