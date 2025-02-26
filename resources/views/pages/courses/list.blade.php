@extends("layouts.main")

@section("title", \App\Models\Course::META['label'])

@section("content")

<x-full-width class="bulletpoints">
    <h1>Wyszukiwarka aktualnych <b>kursów i szkoleń</b> dla logopedów dostępnych w Polsce!</h1>

    <div class="grid col3">
        @foreach (json_decode(App\Models\Setting::get("course_bulletpoints")) ?? [] as $bp)

        @endforeach
    </div>
</x-full-width>

<x-full-width>
    <x-side-content-container flipped>
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
