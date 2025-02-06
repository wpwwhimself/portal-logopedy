<x-full-width class="padded">
    <x-side-content-container>
        <div class="grid big-gap" style="--col-count: 2;">
            <x-tile class="accent background success mid-section-tile">
                <span><b class="large">DODAJ</b></span>
                <span>kurs/szkolenie/...</span>
            </x-tile>
            <x-tile class="accent background secondary mid-section-tile">
                <span><b class="large">OCEŃ</b></span>
                <span>kurs/szkolenie/...</span>
            </x-tile>

            @foreach ([
                ["folder", "Baza kursów, szkoleń, konferencji...", null],
                ["ranking", "Rankingi kursów i szkoleń...", null],
                ["shaker", "Narzędzia do terapii", null],
                ["books", "E-booki, książki, pdfy", null],
                ["people", "Polecani specjaliści", null],
                ["clapper", "Filmy, podcasty", null],
            ] as [$icon_name, $label, $link])
            <x-tile class="grid middle accent primary mid-section-tile">
                <img src="{{ asset("img/icons/$icon_name.svg") }}" alt="{{ $icon_name }}">
                <span>{{ $label }}</span>
            </x-tile>
            @endforeach
        </div>

        <x-slot:side-content>
            <x-blog.highlights />

            <x-tile class="flex right center middle accent ternary">
                <span class="large">Miejsce na Twoją reklamę</span>
            </x-tile>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>
