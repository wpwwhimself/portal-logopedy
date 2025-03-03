@extends("layouts.main")

@section("title", $course->name)
@section("subtitle", "Kursy i szkolenia")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="$course::META['icon']">{{ $course->name }}</x-h>

        @if ($course->thumbnail_path)
        <img src="{{ $course->thumbnail_path }}" alt="{{ $course->name }}">
        @endif

        <p class="ghost">
            {!! $course->trainer_pretty !!}
            {!! $course->full_category_pretty !!}
            <x-icon name="cash" hint="Koszt" />{{ $course->cost }}
        </p>

        <x-h lvl="3" icon="text">Opis</x-h>
        {!! $course->description !!}

        @if ($course->keywords)
        <x-h lvl="3" icon="tag">Słowa kluczowe</x-h>
        <ul>
            @foreach ($course->keywords as $keyword)
            <li>{{ $keyword }}</li>
            @endforeach
        </ul>
        @endif

        @if ($course->image_paths)
        <x-h lvl="3" icon="image">Zdjęcia</x-h>
        <div class="grid col3">
            @foreach ($course->image_paths as $path)
            <a href="{{ $path }}" target="_blank">
                <img src="{{ $path }}" alt="{{ $course->name }}" class="thumbnail">
            </a>
            @endforeach
        </div>
        @endif

        <x-h icon="message-star">Oceny</x-h>
        <x-reviews.list :reviewable="$course" />

        <x-button :action="route('review-add', ['model' => 'course', 'id' => $course->id])" icon="star"
            :disabled="$course->reviewsByCurrentUser()->count() > 0"
        >
            @if ($course->reviewsByCurrentUser()->count() > 0)
            Twoja ocena została dodana
            @else
            Dodaj ocenę
            @endif
        </x-button>

        <x-slot:side-content>
            @if ($course->dates)
            <x-h lvl="3" icon="calendar">Terminy</x-h>
            <ul>
                @foreach ($course->dates as $date)
                <li>{{ Carbon\Carbon::parse($date)->format("d.m.Y H:i") }}</li>
                @endforeach
            </ul>
            @endif

            @if ($course->locations)
            <x-h lvl="3" icon="map-marker">Miejsca</x-h>
            <ul>
                @foreach ($course->locations as $location)
                <li>{{ $location }}</li>
                @endforeach
            </ul>
            @endif

            <x-button :action="$course->link" target="_blank" icon="link">Strona organizatora</x-button>

            {{--  --}}

            <x-button :action="route('front-list', ['model_name' => 'courses'])" class="phantom" icon="arrow-left">Wróć</x-button>

            @if (
                auth()->user()?->hasRole("course-master")
                || auth()->user()?->hasRole("course-manager") && $course->created_by == auth()->user()->id
            )
            <x-button :action="route('admin-edit-model', ['model' => 'courses', 'id' => $course->id])"
                icon="pencil"
                class="accent background tertiary"
                target="_blank"
            >
                Edytuj
            </x-button>
            @endif
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
