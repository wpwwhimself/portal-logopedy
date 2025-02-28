@props([
    "reviewable",
])

@if ($reviewable->reviews->count() == 0)
<span class="ghost">Na razie brak ocen.</span>
@endif

<x-tile title="Dodaj swoją opinię" title-icon="pencil">
    @unless (auth()->user()?->hasRole("reviewer"))
    <x-button :action="route('register')" icon="account-plus">Załóż konto kursanta</x-button>
    @endunless

    <form action="{{ route('review-add') }}" method="POST" class="flex down">
        @csrf
        <input type="hidden" name="reviewable_id" value="{{ $reviewable->id }}">
        <input type="hidden" name="reviewable_type" value="{{ get_class($reviewable) }}">

        <x-input type="text"
            name="title"
            label="Nagłówek"
            icon="text-short"
        />
        <x-input type="TEXT"
            name="description"
            label="Opinia"
            icon="pencil"
        />
        <x-reviews.stars clickable />
        <x-input type="select"
            name="rating"
            label="Ocena"
            icon="star"
            :options="App\Models\Review::RATINGS"
            empty-option
            required
        />

        <x-button action="submit" icon="check">Dodaj opinię</x-button>
    </form>
</x-tile>

<x-h lvl="2">
    Średnia ocen: {{ $reviewable->average_rating }}
    <span class="ghost">({{ $reviewable->reviews->count() }})</span>
</x-h>

@foreach ($reviewable->reviews->take(10) as $review)
<x-reviews.tile :review="$review" />
@endforeach

@if ($reviewable->reviews->count() > 10)
<x-button :action="route('reviews-list', ['model' => Str::afterLast(get_class($reviewable), '\\'), 'id' => $reviewable->id])" icon="more">Zobacz więcej</x-button>
@endif
