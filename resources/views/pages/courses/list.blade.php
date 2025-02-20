@extends("layouts.main")

@section("title", \App\Models\Course::META['label'])

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="\App\Models\Course::META['icon']">{{ \App\Models\Course::META['label'] }}</x-h>

        @forelse ($courses as $course)
        <x-course.tile :course="$course" />
        @empty
        <p class="ghost">Brak danych do wyświetlenia</p>
        @endforelse

        {{ $courses->links() }}

        <x-slot:side-content>

        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
