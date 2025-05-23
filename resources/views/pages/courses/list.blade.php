@extends("layouts.main")

@section("title", \App\Models\Course::META['label'])

@section("content")

<x-full-width class="bulletpoints padded">
    <h1>{{ \App\Models\Setting::get("course_heading") }}</h1>

    <div class="flex right center middle">
        @foreach (collect(json_decode(App\Models\Setting::get("course_bulletpoints")))
            ->sortBy(fn ($bp) => (int) $bp[0])
        as [, $text, $icon_path])
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
            <x-search-bar placeholder="Wyszukaj" model="courses" />

            <div class="flex right middle">
                <div class="pin-right">
                    <strong style="text-align: right;">Wyników: {{ $data->total() }}</strong>

                    @if (Auth::user()?->hasRole("course-manager"))
                    <x-button :action="route('admin-edit-model', ['model' => 'courses'])"
                        icon="plus"
                        class="accent background tertiary"
                    >
                        Dodaj kurs
                    </x-button>
                    @endif
                </div>
            </div>
        </div>

        @forelse ($data as $item)
        <x-model-tile.course :data="$item" />
        @empty
        <p class="ghost">Brak danych do wyświetlenia</p>
        @endforelse

        {{ $data->links() }}

        <x-slot:side-content>
            <x-main.filters model-name="courses" />
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
