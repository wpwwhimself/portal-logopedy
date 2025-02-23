<x-full-width class="padded large">
    <div class="grid col3 but-halfsize-2 but-mobile-down middle but-mobile-reset big-gap">
        @foreach ([
            ["Baza kursów, szkoleń...", route('courses-list')],
            ["Baza specjalistów", route('specialists-list')],
            ["Filmy, podcasty", route('films-list')],
            ["<span><b class=\"large\">DODAJ</b></span><span>kurs/szkolenie/...</span>", route("admin-edit-model", ["model" => "courses"])],
            ["<span><b class=\"large\">OCEŃ</b></span><span>kurs/szkolenie/...</span>", route("courses-list")],
            ["<span><b>Zapisz się na newsletter,</b></span><span>żeby dowiedzieć się, co dla Ciebie przygotowaliśmy!</span>", route("profile")],
        ] as $i => [$label, $link])
        <x-tile class="grid middle accent background {{ $i == 5 ? 'primary' : 'secondary' }} mid-section-tile" no-border :action="$link">
            @if (App\Models\Setting::get("main_tile_".($i+1)."_icon_path"))
            <img src="{{ App\Models\Setting::get("main_tile_".($i+1)."_icon_path") }}" alt="Ikona">
            @endif

            <span>{!! $label !!}</span>
        </x-tile>
        @endforeach
    </div>
</x-full-width>

<x-full-width class="padded large">
    <x-main.course-categories-cloud />
</x-full-width>
