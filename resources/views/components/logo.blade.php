@props([
    "mono" => false,
])

<a href="{{ route('main') }}">
    <img src="{{ ($mono ? App\Models\Setting::get("app_logo_mono_path") : null) ?? App\Models\Setting::get("app_logo_path", asset('img/logo.svg')) }}"
        alt="{{ App\Models\Setting::get("app_name", config("app.name")) }}"
        class="logo"
    >
</a>
