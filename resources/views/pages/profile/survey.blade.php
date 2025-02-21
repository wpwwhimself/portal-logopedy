@extends("layouts.main")

@section("title", "Ankieta")
@section("subtitle", "Mój profil")

@section("content")

<x-full-width>
    <form action="{{ route('profile-process-survey') }}" method="post">
        @csrf

        <x-side-content-container>
            <x-h :icon="$meta['icon']">Ankieta</x-h>

            <p>Wypełnij ankietę i daj nam znać, czego potrzebujesz od naszej aplikacji.</p>

            @foreach ($questions as $question)
            <x-input :type="$question->options ? 'select' : 'text'"
                name="question_{{ $question->id }}"
                :label="$question->name"
                :options="$question->options"
                :empty-option="$question->options"
                :value="auth()->user()->surveyQuestions()->wherePivot('user_survey_question_id', $question->id)->first()?->pivot->answer"
                :hint="$question->description"
            />
            @endforeach

            <x-slot:side-content>
                <x-button action="submit" icon="check">Zapisz</x-button>
                <x-button :action="route('profile')" icon="arrow-left" class="phantom">Wróć</x-button>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
