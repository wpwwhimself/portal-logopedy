<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield("title") |
            @hasSection ("subtitle") @yield("subtitle") | @endif
            {{ config('app.name') }}
        </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('css/core.css') }}">
        <script src="{{ asset('js/core.js') }}" defer></script>
        @yield("extra_head")
    </head>
    <body class="flex down">
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
    </body>
</html>
