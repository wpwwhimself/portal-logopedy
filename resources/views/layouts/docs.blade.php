@extends("layouts.stripped")

@section("title", "Dokumentacja")

@section("content")

<x-side-content-container>
    @yield("doc")

    <x-slot:side-content>
        <x-docs.tree />
    </x-slot:side-content>
</x-side-content-container>

@endsection
