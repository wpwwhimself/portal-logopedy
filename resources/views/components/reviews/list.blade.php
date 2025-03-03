@props([
    "reviewable",
])

@if ($reviewable->reviews->count() == 0)
<span class="ghost">Na razie brak ocen.</span>
@else

<x-h lvl="2">
    Średnia ocen:
    <x-reviews.stars :rating="$reviewable->averageRating()" />
    {{ $reviewable->averageRatingPretty() }}
    <span class="ghost">({{ $reviewable->reviews->count() }})</span>
</x-h>

<x-tile class="flex down">
    @foreach (App\Models\ReviewCriterion::visible()->get() as $criterion)
    <div class="flex right but-mobile-down spread but-mombile-reset">
        <strong>{{ $criterion->name }}</strong>

        <span class="flex right but-mobile-down middle but-mobile-reset">
            @if ($criterion->options)
            {!! $reviewable->averageRatingByCriterionPretty($criterion) !!}
            @else
            <x-button icon="magnify" class="small accent background secondary"
                :action="route('reviews-list', ['model' => Str::lower(Str::afterLast(get_class($reviewable), '\\')), 'id' => $reviewable->id])"
            >
                Udzielono {{ $reviewable->answerCountByCriterion($criterion) }} odpowiedzi
            </x-button>
            @endif
        </span>
    </div>
    @endforeach
</x-tile>

@if ($reviewable->reviews->count() > 10)
<x-button :action="route('reviews-list', ['model' => Str::afterLast(get_class($reviewable), '\\'), 'id' => $reviewable->id])" icon="more">Zobacz więcej</x-button>
@endif

@endif
