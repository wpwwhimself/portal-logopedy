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
        <strong>{{ $criterion->name }}:</strong>
        @if ($criterion->options)
        {{ $criterion->options[$criterion->pivot->answer] }}
        @else
        {{ $criterion->pivot->answer }}
        @endif
    </p>
    @endforeach

    <x-h lvl="3">Ocena końcowa: {{ $review->averageRatingPretty() }}</x-h>
</x-tile>
