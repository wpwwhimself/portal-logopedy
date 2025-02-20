<x-full-width class="accent background secondary padded">
    <x-side-content-container>
        <div class="grid but-mobile-down big-gap" style="--col-count: 2;">
            <x-tile class="flex right middle accent background primary mid-section-tile double" no-border>
                <x-tile class="accent background primary mid-section-tile" no-border>
                    <span><b class="large">DODAJ</b></span>
                    <span>kurs/szkolenie/...</span>
                </x-tile>

                <span>lub</span>

                <x-tile class="accent background primary mid-section-tile" no-border :action="route('courses-list')">
                    <span><b class="large">OCEŃ</b></span>
                    <span>kurs/szkolenie/...</span>
                </x-tile>
            </x-tile>

            @foreach ([
                ["folder", "Baza kursów, szkoleń, konferencji...", route('courses-list')],
                ["ranking", "Rankingi kursów i szkoleń...", route('courses-list')],
                ["shaker", "Narzędzia do terapii", null],
                ["books", "E-booki, książki, pdfy", null],
                ["people", "Polecani specjaliści", null],
                ["clapper", "Filmy, podcasty", null],
            ] as [$icon_name, $label, $link])
            <x-tile class="grid middle accent secondary mid-section-tile" no-border :action="$link">
                <img src="{{ asset("img/icons/$icon_name.svg") }}" alt="{{ $icon_name }}">
                <span>{{ $label }}</span>
            </x-tile>
            @endforeach
        </div>

        <x-slot:side-content>
            <x-blog.highlights />

            <x-tile :action="route('profile')" class="grid middle accent background primary" no-border>
                <img src="{{ asset("img/icons/newsletter.svg") }}" alt="newsletter">
                <div>
                    <span><b>Kliknij i zapisz się na newsletter,</b></span>
                    <span>żeby nie ominęły Cię logopedyczne wydarzenia!</span>
                </div>
            </x-tile>

            @if (App\Models\AdvertSetting::canBeSeen("side"))
            <a href="{{ App\Models\AdvertSetting::get('side', 'link') }}">
                <img src="{{ App\Models\AdvertSetting::get('side', 'image_path') }}" alt="Reklama">
            </a>
            @endif
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>
