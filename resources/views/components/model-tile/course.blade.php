@props([
    "data",
])


<x-tile :action="route('front-view', ['model_name' => 'courses', 'id' => $data->id])"
    class="course grid but-mobile-down middle but-mobile-reset interactive shift-right"
    no-border line-separated
>
    <div class="description flex down">
        <span class="flex right middle big-gap">
            <span>
            @if ($data->dates)
                {{ $data->dates_processed->first() }}
            @else
                dostępny
            @endif
            </span>

            <span>
                {!! $data->locations_pretty !!}
            </span>
        </span>

        <x-h lvl="3">{{ $data->name }}</x-h>

        <span class="flex right middle">
            {!! $data->trainer_pretty !!}
        </span>

        <x-reviews.score :reviewable="$data" />
    </div>

    <div>
        @if ($data->cost)
        <strong class="flex right middle {{ $data->isFree() ? "accent tertiary" : "" }}">
            {{ $data->cost_pretty }}
        </strong>
        @endif
    </div>
</x-tile>
