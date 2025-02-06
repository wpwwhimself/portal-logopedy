@extends("layouts.main")

@section("title", "Rejestracja")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account-plus">Rejestracja</x-h>
        <x-auth.login-form mode="register" />

        <x-slot:side-content>
            <x-hint title="Co zyskasz z rejestracji?">
                <p>Jeszcze nie wiem, ale coś na pewno...</p>
            </x-hint>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
