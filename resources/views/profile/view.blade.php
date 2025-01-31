@extends("layouts.main")

@section("title", "Mój profil")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account">{{ auth()->user()->name }}</x-h>

        <x-slot:side-content>
            <x-button :action="route('logout')" icon="logout" class="phantom">Wyloguj się</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
