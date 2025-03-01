@extends("layouts.main")

@section("title", $entity->name)
@section("subtitle", "Opinie")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="App\Models\Review::META['icon']">{{ $entity->name }} – opinie</x-h>

        @forelse ($reviews as $review)
        <x-reviews.tile :review="$review" />
        @empty
        <p class="ghost">Brak danych do wyświetlenia</p>
        @endforelse

        {{ $reviews->links() }}

        <x-slot:side-content>
            <x-button :action="route('front-view-'.Str::lower($model), [Str::lower($model) => $entity])" icon="arrow-left" class="phantom">Wróć</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
