@extends("layouts.main")

@section("title", "Strona główna")

@section("content")

@if (App\Models\AdvertSetting::canBeSeen("thin"))
<x-main.line-banner :action="App\Models\AdvertSetting::get('thin', 'link')"
    background-style="
        background-color: {{ App\Models\AdvertSetting::get('thin', 'background-color') }};
        color: {{ App\Models\AdvertSetting::get('thin', 'white_text') ? 'white' : 'black' }};
    "
>
    {{ App\Models\AdvertSetting::get("thin", "content") }}
</x-main.line-banner>
@endif

@if (App\Models\AdvertSetting::canBeSeen("big"))
<x-main.line-banner class="large" :action="App\Models\AdvertSetting::get('big', 'link')">
    <img src="{{ App\Models\AdvertSetting::get('big', 'image_path') }}" alt="Reklama">
</x-main.line-banner>
@endif

<x-main.line-banner background-class="accent background primary">
    <span class="large">
        <b>Kliknij i zapisz się na newsletter</b>,
        żeby nie ominęło Cię żadne logopedyczne wydarzenie!
    </span>
</x-main.line-banner>

<x-main.mid-section />

<x-main.line-banner background-class="accent background secondary"
    :action="route('register')"
>
    <span class="large">
        Oszczędzisz czas i pieniądze!
        Kliknij w baner i dołącz do portalu.
    </span>
</x-main.line-banner>

@endsection
