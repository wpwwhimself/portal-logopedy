@extends("layouts.main")

@section("title", "Logowanie")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account">Logowanie</x-h>
        <x-auth.login-form />

        <x-slot:side-content>
            <x-hint>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt, laborum alias voluptatum iste sint tempora adipisci quidem. Consequatur quae nemo nulla commodi inventore vel molestiae! Maxime sit possimus animi magnam.</p>
            </x-hint>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
