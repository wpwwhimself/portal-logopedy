@extends("layouts.main")

@section("title", $data->name)
@section("subtitle", $data::META['label'])

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="$data::META['icon']">{{ $data->name }}</x-h>

        @if ($data->thumbnail_path)
        <img src="{{ $data->thumbnail_path }}" alt="{{ $data->name }}">
        @endif

        <ul>
            @foreach ([
                ["trainer_organization", $data->trainer_pretty],
                ["categories", $data->full_category_pretty],
            ] as [$field_name, $value])
            <li>
                <strong>{{ $data::FIELDS[$field_name]['label'] }}</strong>:
                {!! $value !!}
            </li>
            @endforeach
        </ul>

        <x-h lvl="3" icon="text">Opis</x-h>
        {!! $data->description !!}

        @if ($data->keywords)
        <x-h lvl="3" icon="tag">Słowa kluczowe</x-h>
        <ul>
            @foreach ($data->keywords as $keyword)
            <li>{{ $keyword }}</li>
            @endforeach
        </ul>
        @endif

        @if ($data->image_paths)
        <x-h lvl="3" icon="image">Zdjęcia</x-h>
        <div class="grid col3 but-halfsize-2">
            @foreach ($data->image_paths as $path)
            <a href="{{ $path }}" target="_blank">
                <img src="{{ $path }}" alt="{{ $data->name }}" class="thumbnail">
            </a>
            @endforeach
        </div>
        @endif

        <x-h icon="message-star">Oceny</x-h>
        <x-reviews.list :reviewable="$data" />

        <x-button :action="route('review-add', ['model' => 'course', 'id' => $data->id])" icon="star"
            :disabled="$data->reviewsByCurrentUser()->count() > 0"
        >
            @if ($data->reviewsByCurrentUser()->count() > 0)
            Twoja ocena została dodana
            @else
            Dodaj ocenę
            @endif
        </x-button>

        <x-slot:side-content>
            <x-h lvl="3" :icon="$data::FIELDS['dates']['icon']">Terminy</x-h>
            <ul>
                @if ($data->dates)
                @foreach ($data->dates_processed as $date)
                <li>{{ $date }}</li>
                @endforeach
                @else
                <p>dostępny</p>
                @endif
            </ul>

            @if ($data->location)
            <x-h lvl="3" :icon="$data::FIELDS['location']['icon']">Miejsce</x-h>
            <span>{{ $data->location }}</span>
            @endif

            @if ($data->cost)
            <x-h lvl="3" :icon="$data::FIELDS['cost']['icon']">Koszt</x-h>
            <span>{{ $data->cost_pretty }}</span>
            @endif

            <x-button :action="$data->link" target="_blank" icon="link">Strona organizatora</x-button>

            <x-button :action="route('error-report-view', ['model_name' => 'courses', 'id' => $data->id])" icon="bug" class="accent background tertiary">Zgłoś błąd</x-button>

            {{--  --}}

            <x-button :action="route('front-list', ['model_name' => 'courses'])" class="phantom" icon="arrow-left">Wróć</x-button>

            @if (
                auth()->user()?->hasRole("course-master")
                || auth()->user()?->hasRole("course-manager") && $data->created_by == auth()->user()->id
            )
            <x-button :action="route('admin-edit-model', ['model' => 'courses', 'id' => $data->id])"
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
