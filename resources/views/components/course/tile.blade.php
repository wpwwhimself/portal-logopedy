@props([
    "course",
])


<x-tile :action="route('front-view-course', ['course' => $course])"
    class="course grid but-mobile-down middle but-mobile-reset interactive shift-right"
    no-border line-separated
>
    <div class="description flex down">
        <span class="flex right middle big-gap">
            @if ($course->dates)
            <span {{ Popper::pop(Carbon\Carbon::parse($course->dates->sort()->first())) }}>
                {{ Carbon\Carbon::parse($course->dates->sort()->first())->diffForHumans() }}
            @else
            <span>
                dostępny
            @endif
            </span>

            <span>
                {!! $course->location_pretty !!}
            </span>
        </span>

        <x-h lvl="3">{{ $course->name }}</x-h>

        <span class="flex right middle">
            {!! $course->trainer_pretty !!}
        </span>

        <x-reviews.score :reviewable="$course" />
    </div>

    <div>
        @if ($course->cost)
        <strong class="flex right middle {{ $course->isFree() ? "accent tertiary" : "" }}">
            {{ $course->cost }}
        </strong>
        @endif
    </div>
</x-tile>
