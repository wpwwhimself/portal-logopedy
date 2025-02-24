@props([
    "review",
])

<x-tile :title="$review->title" :title-icon="App\Models\Review::META['icon']">
    <p class="ghost">
        {!! $review->creator !!}
        <x-reviews.stars :rating="$review->rating" />
    </p>
    <p>{{ $review->description }}</p>
</x-tile>
