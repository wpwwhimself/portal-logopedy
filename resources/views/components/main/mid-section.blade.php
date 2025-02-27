<x-full-width class="padded large">
    <div class="grid col3 but-halfsize-2 but-mobile-down middle but-mobile-reset big-gap">
        @foreach (array_merge(App\View\Components\Nav::navLinks(), [
            ["<span><b class=\"large\">OCEŃ</b></span><span>kurs/szkolenie/...</span>", route("courses-list")],
            ["O Portalu", route("standard-page", ["slug" => "o-portalu"])],
            ["<span><b>Zapisz się na newsletter,</b></span><span>żeby dowiedzieć się, co dla Ciebie przygotowaliśmy!</span>", route("profile")],
        ]) as $i => [$label, $link])
        <x-tile class="grid middle accent background {{ $i == 5 ? 'primary' : 'secondary' }} mid-section-tile" no-border :action="$link">
            @if (App\Models\Setting::get("main_tile_".($i+1)."_icon_path"))
            <img src="{{ App\Models\Setting::get("main_tile_".($i+1)."_icon_path") }}" alt="Ikona">
            @endif

            <span>{!! $label !!}</span>
        </x-tile>
        @endforeach
    </div>
</x-full-width>
