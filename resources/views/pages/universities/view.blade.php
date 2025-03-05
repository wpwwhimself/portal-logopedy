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

        <x-button :action="route('review-add', ['model' => 'university', 'id' => $data->id])" icon="star"
            :disabled="$data->reviewsByCurrentUser()->count() > 0"
        >
            @if ($data->reviewsByCurrentUser()->count() > 0)
            Twoja ocena została dodana
            @else
            Dodaj ocenę
            @endif
        </x-button>

        <x-slot:side-content>
            @if ($data->location)
            <x-h lvl="3" :icon="$data::FIELDS['location']['icon']">Miejsce</x-h>
            <span>{{ $data->location }}</span>
            @endif

            @if ($data->cost)
            <x-h lvl="3" :icon="$data::FIELDS['cost']['icon']">Koszt</x-h>
            <span>{{ $data->cost_pretty }}</span>
            @endif

            <x-button :action="$data->link" target="_blank" icon="link">Strona organizatora</x-button>

            {{--  --}}

            <x-button :action="route('front-list', ['model_name' => 'courses'])" class="phantom" icon="arrow-left">Wróć</x-button>

            @if (
                auth()->user()?->hasRole("university-master")
            )
            <x-button :action="route('admin-edit-model', ['model' => 'universities', 'id' => $data->id])"
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
