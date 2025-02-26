@extends("layouts.main")

@section("title", "Strona główna")

@section("content")

@if (App\Models\Setting::get("welcome_banner_path"))
<x-main.banner :src="App\Models\Setting::get('welcome_banner_path')" :alt="App\Models\Setting::get('app_name')" />
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

@endsection

@section("content_after")

<x-full-width class="padded large">
    <x-main.course-categories-cloud />
</x-full-width>

@if (App\Models\AdvertSetting::canBeSeen("big"))
<x-main.banner :src="App\Models\AdvertSetting::get('big', 'image_path')" alt="Reklama" :action="App\Models\AdvertSetting::get('big', 'link')" />
@endif

<x-full-width class="padded large accent background secondary">
    <x-blog.highlights />
</x-full-width>

@endsection
