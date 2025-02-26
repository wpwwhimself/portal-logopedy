@extends("layouts.base")

@section("extra_head")
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section("header")
<x-header />
@endsection

@section("body")

@yield("content")

<x-main.mid-section />

@yield("content_after")

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
