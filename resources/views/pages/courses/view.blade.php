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

            @if (
                auth()->user()->hasRole("course-master")
                || auth()->user()->hasRole("course-manager") && $course->created_by == auth()->user()->id
            )
            <x-button :action="route('admin-edit-model', ['model' => 'courses', 'id' => $course->id])"
                icon="pencil"
                class="accent background tertiary"
                target="_blank"
            >
                Edytuj
            </x-button>
            @endif
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
