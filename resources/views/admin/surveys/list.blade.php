@extends("layouts.admin")

@section("title", "Ankiety")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="$meta['icon']">Ankiety</x-h>

        <p class="ghost">Tu przejrzysz odpowiedzi udzielone przez użytkowników na pytania zadane w ankiecie.</p>

        @forelse ($users as $user)
        <x-tile :title="$user->name" :title-icon="\App\Models\User::META['icon']" :action="route('admin-edit-model', ['model' => 'users', 'id' => $user->id])">
            @foreach ($user->surveyQuestions as $question)
            <p>{{ $question->name }}: {{ $question->pivot->answer }}</p>
            @endforeach
        </x-tile>
        @empty
        <p class="ghost">Brak danych do wyświetlenia</p>
        @endforelse

        {{ $users->links() }}

        <x-slot:side-content>
            <x-button :action="route('admin-list-model', ['model' => 'user-survey-questions'])" icon="arrow-left" class="phantom">Wróć</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
