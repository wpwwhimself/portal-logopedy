@props([
    "data",
])


<x-tile :action="route('front-view', ['model_name' => 'films', 'id' => $data->id])"
    class="course grid but-mobile-down middle but-mobile-reset interactive shift-right"
    no-border line-separated
>

    <div class="description flex down">
        <x-h lvl="3">{{ $data->name }}</x-h>

        <p>{{ Str::of($data->description)->stripTags()->words(10) }}</p>

        {{-- <x-reviews.score :reviewable="$data" /> --}}
    </div>

    <div class="thumbnail">
        @if ($data->thumbnail_path)
        <img src="{{ $data->thumbnail_path }}" alt="{{ $data->name }}" class="thumbnail">
        @endif
    </div>
</x-tile>
