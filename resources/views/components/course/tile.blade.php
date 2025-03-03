@props([
    "course",
])


<x-tile :action="route('front-view-course', ['course' => $course])"
    class="course grid but-mobile-down middle but-mobile-reset interactive shift-right"
    no-border line-separated
>
    <div class="description flex down no-gap">
        <span class="flex right middle">
            <x-icon name="calendar" hint="Najbliższy termin" />
            @if ($course->dates)
            <span {{ Popper::pop(Carbon\Carbon::parse($course->dates->sort()->first())) }}>
                {{ Carbon\Carbon::parse($course->dates->sort()->first())->diffForHumans() }}
            @else
            <span>
                Dostępny
            @endif
            </span>

            {!! $course->location_pretty !!}
        </span>

        <x-h lvl="2">{{ $course->name }}</x-h>

        <span class="flex right middle">
            {!! $course->trainer_pretty !!}
        </span>

        <x-reviews.score :reviewable="$course" />
    </div>

    <div>
        @if ($course->cost)
        <strong class="flex right middle {{ $course->isFree() ? "accent tertiary" : "" }}">
            {!! $course->pretty("cost") !!}
        </strong>
        @endif
    </div>
</x-tile>
