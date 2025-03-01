@props([
    "reviewable",
])

<div class="score flex right middle">
    <strong class="accent tertiary">{{ $reviewable->averageRatingPretty() }}</strong>

    <x-reviews.stars :rating="$reviewable->averageRating() ?? 0" />

    <span>({{ $reviewable->reviews->count() }})</span>

    <x-button class="accent background tertiary small">
        Dodaj opinię
    </x-button>
</div>
