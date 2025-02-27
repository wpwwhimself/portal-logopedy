@props([
    "reviewable",
])

<div class="score flex right middle">
    <strong class="accent tertiary">{{ $reviewable->average_rating_pretty }}</strong>

    <div class="flex right middle no-gap accent tertiary">
        @for ($i = 0; $i < 5; $i++)
        <x-icon :name="$i < $reviewable->average_rating ? 'star' : 'star-outline'" />
        @endfor
    </div>

    <span>({{ $reviewable->reviews->count() }})</span>

    <x-button class="accent background tertiary small">
        Dodaj opinię
    </x-button>
</div>
