@extends("layouts.main")

@section("title", "Mój profil")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account">{{ auth()->user()->name }}</x-h>

        <x-tile>
            <x-h lvl="2" icon="key-chain">Moje uprawnienia</x-h>

            <ul>
                @forelse (auth()->user()->roles as $role)
                <li><b>{{ $role->name }}</b>: {{ $role->description }}</li>
                @empty
                <li>Brak nadanych uprawnień</li>
                @endforelse
            </ul>
        </x-tile>

        <x-slot:side-content>
            <x-button :action="route('change-password')" icon="key-change" class="phantom">Zmień hasło</x-button>
            <x-button :action="route('logout')" icon="logout" class="phantom">Wyloguj się</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
