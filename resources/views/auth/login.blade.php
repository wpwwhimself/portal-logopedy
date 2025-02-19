@extends("layouts.main")

@section("title", "Logowanie")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account">Logowanie</x-h>
        <x-auth.login-form />

        <x-slot:side-content>
            <x-hint>
                <p>
                    Na swoim koncie możesz zapisać się do naszego newslettera,
                    dzięki czemu nie przegapisz żadnego ważnego wydarzenia.
                </p>
            </x-hint>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
