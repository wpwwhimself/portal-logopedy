@extends("layouts.main")

@section("title", "Strona główna")

@section("content")

@if (App\Models\Setting::get("welcome_banner_path"))
<img src="{{ App\Models\Setting::get("welcome_banner_path") }}" class="full-width" alt="{{ App\Models\Setting::get("app_name") }}">
@endif

@if (App\Models\AdvertSetting::canBeSeen("thin"))
<x-main.line-banner :action="App\Models\AdvertSetting::get('thin', 'link')"
    background-style="
        background-color: {{ App\Models\AdvertSetting::get('thin', 'background-color') }};
        color: {{ App\Models\AdvertSetting::get('thin', 'white_text') ? 'white' : 'black' }};
    "
>
    {!! App\Models\AdvertSetting::get("thin", "content") !!}
</x-main.line-banner>
@endif

<x-main.mid-section />

@if (App\Models\AdvertSetting::canBeSeen("big"))
<x-main.line-banner class="large" :action="App\Models\AdvertSetting::get('big', 'link')">
    <img src="{{ App\Models\AdvertSetting::get('big', 'image_path') }}" alt="Reklama">
</x-main.line-banner>
@endif

<x-full-width class="padded large accent background secondary">
    <x-blog.highlights />
</x-full-width>

@if (App\Models\AdvertSetting::canBeSeen("lower_thin"))
<x-main.line-banner :action="App\Models\AdvertSetting::get('lower_thin', 'link')"
    background-style="
        background-color: {{ App\Models\AdvertSetting::get('lower_thin', 'background-color') }};
        color: {{ App\Models\AdvertSetting::get('lower_thin', 'white_text') ? 'white' : 'black' }};
    "
>
    {!! App\Models\AdvertSetting::get("lower_thin", "content") !!}
</x-main.line-banner>
@endif

@endsection
