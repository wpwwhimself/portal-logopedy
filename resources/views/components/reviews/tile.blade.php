@props([
    "review",
])

<x-tile>
    <x-h lvl="2">
        {!! $review->creator !!}
        <x-reviews.stars :rating="$review->averageRating()" />
        {{ $review->averageRatingPretty() }}
    </x-h>

    <div class="flex down">
        @foreach ($review->criteria as $criterion)
        <div class="flex right but-mobile-down spread but-mombile-reset">
            <strong>{{ $criterion->name }}</strong>

            <span class="flex right but-mobile-down middle but-mobile-reset">
                @if ($criterion->options)
                {{ $criterion->options[$criterion->pivot->answer] }}
                <x-reviews.stars :rating="$criterion->pivot->answer" />
                @else
                {{ $criterion->pivot->answer }}
                @endif
            </span>
        </div>
        @endforeach
    </div>
</x-tile>
