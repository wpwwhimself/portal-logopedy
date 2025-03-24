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

        <div class="flex right center middle">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $data->youtube_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>

        <x-h lvl="3">Opis</x-h>
        {!! $data->description !!}

        <div class="grid" style="--col-count: 2;">
            <div>
                @if ($data->locations?->isNotEmpty())
                <x-h lvl="3" :icon="$data::FIELDS['locations']['icon']">Miejsca</x-h>
                <ul>
                    @foreach ($data->locations as $location)
                    <li>{{ $location }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div>
                @if (!empty($data->cost))
                <x-h lvl="3" :icon="$data::FIELDS['cost']['icon']">Koszt</x-h>
                <span>{{ $data->cost_pretty }}</span>
                @endif
            </div>
        </div>

        @if ($data->keywords?->isNotEmpty())
        <x-h lvl="3">Słowa kluczowe</x-h>
        <div class="flex right">
            @foreach ($data->keywords as $keyword)
            <span>{{ $keyword }}</span>
            @endforeach
        </div>
        @endif

        {{--
        <x-h icon="message-star">Oceny</x-h>
        <x-reviews.list :reviewable="$data" />

        <x-button :action="route('review-add', ['model' => 'film', 'id' => $data->id])" icon="star"
            :disabled="$data->reviewsByCurrentUser()->count() > 0"
        >
            @if ($data->reviewsByCurrentUser()->count() > 0)
            Twoja ocena została dodana
            @else
            Dodaj ocenę
            @endif
        </x-button>
        --}}

        <x-slot:side-content>
            <x-button :action="route('front-list', ['model_name' => 'films'])" class="phantom" icon="arrow-left">Wróć</x-button>

            @if (
                auth()->user()?->hasRole("film-master")
            )
            <x-button :action="route('admin-edit-model', ['model' => 'films', 'id' => $data->id])"
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
