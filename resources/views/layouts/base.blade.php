<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- metadata --}}
        <meta name="author" content="{{ App\Models\Setting::get("metadata_author") }}">
        <meta name="description" content="{{ App\Models\Setting::get("metadata_description") }}">
        <meta name="keywords" content="{{ App\Models\Setting::get("metadata_keywords") }}">

        <meta property="og:title" content="{{ App\Models\Setting::get("metadata_title") }}">
        <meta property="og:description" content="{{ App\Models\Setting::get("metadata_description") }}">
        <meta property="og:image" content="{{ App\Models\Setting::get("metadata_image") }}">
        <meta property="og:url" content="{{ route("main") }}">
        <meta property="og:type" content="website">

        <link rel="icon" href="{{ App\Models\Setting::get("app_favicon_path") }}">

        {!! App\Models\Setting::get("metadata_google_tag_code") !!}

        <title>
            @yield("title") |
            @hasSection ("subtitle") @yield("subtitle") | @endif
            {{ App\Models\Setting::get("app_name", config('app.name')) }}
        </title>

        <link rel="stylesheet" href="{{ asset('css/core.css') }}">
        <script src="{{ asset('js/earlies.js') }}"></script>
        <script src="{{ asset('js/core.js') }}" defer></script>
        @yield("extra_head")

        <style>
        :root {
            --primary: {{ App\Models\Setting::get("color_primary") }};
            --secondary: {{ App\Models\Setting::get("color_secondary") }};
            --tertiary: {{ App\Models\Setting::get("color_tertiary") }};
        }
        </style>

        {{-- @env (["local", "stage"])
        <style>
        :root {
            @env ("local")
            --test-color: #0f0;
            @endenv
            @env ("stage")
            --test-color: #ff0;
            @endenv
        }
        header {
            background: repeating-linear-gradient(45deg, var(--test-color), var(--test-color) 25px, #000 25px, #000 50px) !important;
        }
        </style>
        @endenv --}}

        {{-- ckeditor --}}
        <link rel="stylesheet" href="{{ asset("css/ckeditor.css") }}?{{ time() }}">
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
        <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
            }
        }
        </script>
        <script type="module" src="{{ asset("js/ckeditor.js") }}?{{ time() }}"></script>
    </head>
    <body class="flex down {{ Route::currentRouteNamed("main") ? "no-gap" : "" }}">
        <!-- Page Heading -->
        @yield("header")

        <!-- Page Content -->
        <main>
            @yield("body")
        </main>

        {{-- Alerts --}}
        @foreach (['success', 'error'] as $status)
        @if (session($status))
        <x-alert :status="$status" />
        @endif
        @endforeach

        <x-footer />

        @include("popper::assets")
    </body>
</html>
