@extends("layouts.stripped")

@section("title", "Zgłoszenie błędu")

@section("content")

<x-full-width>
    <form action="{{ route('error-report-process') }}" method="post">
        @csrf
        <input type="hidden" name="model_name" value="{{ $model_name }}">
        <input type="hidden" name="id" value="{{ $id }}">

        <x-side-content-container>
            <x-h icon="bug">Zgłoszenie błędu</x-h>

            <p>
                Dziękujemy za zgłoszenie błędu.
                Pomaga to nam w utrzymywaniu danych na naszej stronie w jak najlepszym stanie.
                Poniżej opisz, jakie wyświetlane dane są błędne i jak możemy je poprawić.
            </p>

            <p>
                Zgłoszenie dotyczy:
                <strong>{{ $entity->name }}</strong>
                ({{ $model::META['label'] }})
            </p>

            <x-input type="TEXT"
                name="description"
                label="Opis błędu"
                icon="bug"
                required
            />

            <x-slot:side-content>
                <x-button action="submit" icon="check">Wyślij</x-button>
                <x-button icon="arrow-left" class="phantom" :action="route('front-view', ['model_name' => $model_name, 'id' => $id])">Wróć</x-button>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
