<x-full-width class="padded">
    <x-side-content-container>
        <div class="grid big-gap" style="--col-count: 2;">
            <x-button class="accent background success">
                <b class="large">DODAJ</b>
                kurs/szkolenie/..
            </x-button>
            <x-button class="accent background secondary">
                <b class="large">OCEŃ</b>
                kurs/szkolenie/..
            </x-button>

            @foreach ([1, 2, 3, 4, 5, 6] as $tile)
            <x-tile class="flex right middle accent primary">
                @svg("mdi-folder-outline")
                <span>Kafelek</span>
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
