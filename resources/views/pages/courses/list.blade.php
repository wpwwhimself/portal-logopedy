@extends("layouts.main")

@section("title", \App\Models\Course::META['label'])

@section("content")

<x-full-width class="bulletpoints padded">
    <h1>Wyszukiwarka aktualnych <b>kursów i szkoleń</b> dla logopedów dostępnych w Polsce!</h1>

    <div class="flex right center middle">
        @foreach ($bulletpoints as [, $text, $icon_path])
        <div class="grid middle">
            <div class="icon-container flex right center middle">
                <img src="{{ $icon_path }}" alt="Ikona">
            </div>
            <p>{{ $text }}</p>
        </div>
        @endforeach
    </div>
</x-full-width>

<hr>

<x-full-width>
    <x-side-content-container flipped>
        <div class="grid col2 middle">
            <x-search-bar placeholder="Wyszukaj" />
            <strong style="text-align: right;">Wyników: {{ $courses->total() }}</strong>
        </div>

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
