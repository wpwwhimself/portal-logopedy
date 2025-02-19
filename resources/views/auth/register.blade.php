@extends("layouts.main")

@section("title", "Rejestracja")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account-plus">Rejestracja</x-h>
        <x-auth.login-form mode="register" />

        <x-slot:side-content>
            <x-hint title="Co zyskasz z rejestracji?">
                <p>
                    Rejestracja pozwoli Ci oceniać kursy i szkolenia.
                    Jeśli zarejestrujesz się jako twórca, będziesz mógł dodawać własne kursy i reklamować swoje szkolenia.
                    Konto pozwala również na zapisanie się do naszego newslettera.
                </p>
            </x-hint>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
