@extends("layouts.main")

@section("title", $course->name)
@section("subtitle", "Kursy i szkolenia")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="$course::META['icon']">{{ $course->name }}</x-h>

        <div class="placeholder">Zostanie uzupełnione wkrótce</div>

        <x-slot:side-content>
            <x-button :action="route('courses-list')" class="phantom" icon="arrow-left">Wróć</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
