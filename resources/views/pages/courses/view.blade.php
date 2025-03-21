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
                ["trainer_name", $data->trainer_name],
                ["trainer_organization", $data->trainer_organization],
                ["categories", $data->full_category_pretty],
            ] as [$field_name, $value])
            <li>
                <strong>{{ $data::FIELDS[$field_name]['label'] }}</strong>:
                {!! $value !!}
            </li>
            @endforeach
        </ul>

        <x-h lvl="3">Opis</x-h>
        {!! $data->description !!}

        <div class="grid" style="--col-count: 3;">
            <div>
                <x-h lvl="3">Terminy</x-h>
                <ul>
                    @if ($data->dates)
                    @foreach ($data->dates_processed as $date)
                    <li>{{ $date }}</li>
                    @endforeach
                    @else
                    <p>dostępny</p>
                    @endif
                </ul>
            </div>

            @if ($data->locations?->isNotEmpty())
            <div>
                <x-h lvl="3">Miejsca</x-h>
                <ul>
                    @foreach ($data->locations as $location)
                    <li>{{ $location }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (!empty($data->cost))
            <div>
                <x-h lvl="3">Koszt</x-h>
                <span>{{ $data->cost_pretty }}</span>
            </div>
            @endif
        </div>

        @if ($data->keywords?->isNotEmpty())
        <x-h lvl="3">Słowa kluczowe</x-h>
        <div class="flex right">
            @foreach ($data->keywords as $keyword)
            <span>{{ $keyword }}</span>
            @endforeach
        </div>
        @endif

        @if ($data->image_paths?->isNotEmpty())
        <x-h lvl="3">Zdjęcia</x-h>
        <div class="grid col3 but-halfsize-2">
            @foreach ($data->image_paths as $path)
            <a href="{{ $path }}" target="_blank">
                <img src="{{ Str::startsWith($path, 'https://') ? $path : 'https://wsrv.nl/?url='.$path }}" alt="{{ $data->name }}" class="thumbnail">
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
