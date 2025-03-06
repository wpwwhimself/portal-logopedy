@extends("layouts.main")

@section("title", "Zmiana hasła")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account-plus">Zmiana hasła</x-h>
        <x-auth.login-form mode="{{ isset($token) ? 'reset' : 'change' }}-password" />

        <x-slot:side-content>
            <x-hint title="Jak silne musi być hasło?">
                <p>Hasło powinno być wystarczająco skomplikowane, żeby zapamiętanie go było na granicy Twoich możliwości.</p>
            </x-hint>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
