@props([
    "course",
])


<x-tile :action="route('course-view', ['course' => $course])"
    class="course flex right middle interactive shift-right"
    no-border line-separated
>
    <div class="description flex down no-gap">
        <span class="flex right middle">
            @if ($course->dates)
            <x-icon name="calendar" hint="Najbliższy termin" />
            {{ Carbon\Carbon::parse($course->dates->sort()->first())->diffForHumans() }}
            @endif

            {!! $course->location_pretty !!}
        </span>

        <x-h lvl="2">{{ $course->name }}</x-h>

        <span class="flex right middle">
            {!! $course->trainer_pretty !!}
        </span>

        <x-reviews.score :reviewable="$course" />
    </div>

    <div class="pin-right">
        @if ($course->cost)
        <strong class="flex right middle">
            {!! $course->pretty("cost") !!}
        </strong>
        @endif
    </div>
</x-tile>
