@props([
    "review",
])

<x-tile>
    <x-h lvl="2">
        {!! $review->creator !!}
        <x-reviews.stars :rating="$review->averageRating()" />
    </x-h>

    @foreach ($review->criteria as $criterion)
    <p>
        <strong>{{ $criterion->name }}:</strong> {{ $criterion->pivot->answer }}
    </p>
    @endforeach
</x-tile>
