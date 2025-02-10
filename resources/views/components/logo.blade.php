<a href="{{ route('main') }}">
    <img src="{{ App\Models\Setting::get("app_logo_path", asset('img/logo.svg')) }}"
        alt="{{ App\Models\Setting::get("app_name", config("app.name")) }}"
        class="logo"
    >
</a>
