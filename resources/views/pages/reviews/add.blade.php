@extends("layouts.stripped")

@section("title", "Dodaj opinię")
@section("subtitle", $entity->name)

@section("content")

<x-full-width>
    <form action="{{ route('review-process') }}" method="post">
        @csrf

        <x-side-content-container>
            <x-h :icon="App\Models\Review::META['icon']">Formularz oceny szkolenia/kursu na {{ App\Models\Setting::get("app_name") }}</x-h>

            <p>
                Twoja opinia pomaga kształtować jakość szkoleń i wspiera społeczność logopedów w wyborze wartościowych kursów. Wypełnienie formularza zajmie Ci ok. 2-3 minuty. Dziękujemy za Twój wkład!
            </p>

            <x-input type="checkbox"
                name="confirmed"
                label="Potwierdzam, że brałam/em udział w tym szkoleniu i akceptuję <a href='/pages/regulamin'>regulamin</a>"
                icon="check"
                required
            />

            <input type="hidden" name="reviewable_type" value="{{ get_class($entity) }}">
            <input type="hidden" name="reviewable_id" value="{{ $entity->id }}">
            <input type="hidden" name="model" value="{{ $model }}">

            @foreach ($criteria as $criterion)
            <x-input :type="$criterion->options ? 'select' : 'TEXT'"
                name="criterion_{{ $criterion->id }}"
                :label="$criterion->name"
                :icon="$criterion::META['icon']"
                :hint="$criterion->description"
                :options="$criterion->options"
            />
            @endforeach

            <x-slot:side-content>
                <x-button action="submit" name="method" value="save" icon="check">Zapisz</x-button>
                <x-button :action="route('front-list', ['model_name' => Str::plural($model)])"
                    icon="arrow-left"
                    class="phantom"
                >
                    Wróć
                </x-button>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
