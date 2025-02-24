@props([
    "course",
])

<x-tile :action="route('course-view', ['course' => $course])"
    class="course flex right interactive shift-right"
>
    <div class="description flex down">
        <x-h lvl="2">{{ $course->name }}</x-h>

        <x-reviews.score :reviewable="$course" />

        <span>{!! $course->full_category_pretty !!}</span>

        <span class="ghost">{!! $course->trainer_pretty !!}</span>

        {{-- <div class="flex right">
            @foreach ($course->industries as $industry)
            <x-tag>{{ $industry->name }}</x-tag>
            @endforeach
        </div> --}}
    </div>

    <div class="details flex down">
        @if ($course->dates)
        <span class="flex right middle">
            <x-icon name="calendar" hint="Najbliższy termin" />
            {{ Carbon\Carbon::parse($course->dates->sort()->first())->diffForHumans() }}
        </span>
        @endif

        <span class="flex right middle">
            {!! $course->location_pretty !!}
        </span>

        @if ($course->cost)
        <span class="flex right middle">
            <x-icon name="cash" hint="Koszt" />
            {{ $course->cost }}
        </span>
        @endif
    </div>

    @if ($course->thumbnail_path)
    <img src="{{ $course->thumbnail_path }}" alt="{{ $course->name }}" class="thumbnail pin-right">
    @endif
</x-tile>
