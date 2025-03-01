@extends("layouts.stripped")

@section("title", "Dodaj opinię")
@section("subtitle", $entity->name)

@section("content")

<x-full-width>
    <form action="{{ route('review-process') }}" method="post">
        @csrf

        <x-side-content-container>
            <x-h :icon="App\Models\Review::META['icon']">Dodaj opinię</x-h>

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
