@extends("layouts.main")

@section("title", "Resetowanie hasła")

@section("content")

<x-full-width>
    <form action="{{ route('process-forgot-password') }}" method="post">
        @csrf

        <x-side-content-container>
            <x-h icon="key-change">Resetowanie hasła</x-h>

            <p>
                Podaj adres email, na który wyślemy link do resetowania hasła.
            </p>

            <x-input type="email"
                name="email"
                label="Adres email"
                icon="email"
                required
            />

            <x-button action="submit" icon="check">Wyślij</x-button>

            <x-slot:side-content>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
