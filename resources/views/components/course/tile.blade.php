@props([
    "course",
])

<a href="{{ route('course-view', ['course' => $course]) }}" {{ $attributes->class([
    "course",
    "flex", "right",
    "interactive", "shift-right",
]) }}>
    @if ($course->thumbnail_path)
    <img src="{{ $course->thumbnail_path }}" alt="{{ $course->name }}" class="thumbnail">
    @endif

    <div class="description flex down">
        <x-h lvl="2">{{ $course->name }}</x-h>

        <span>
            <x-icon :name="$course::FIELDS['category']['icon']" />
            {{ $course->full_category }}
        </span>

        <span class="ghost">{{ $course->trainer }}</span>

        <big class="placeholder">TU BĘDĄ OCENY</big>

        {{-- <div class="flex right">
            @foreach ($course->industries as $industry)
            <x-tag>{{ $industry->name }}</x-tag>
            @endforeach
        </div> --}}
    </div>
</a>
