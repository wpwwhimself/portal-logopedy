@extends("layouts.stripped")

@section("content")

<section style="text-align: center;">
    <h1 style="font-size: 3em;">
        {{ $exception->getStatusCode() }} | @yield("title")
    </h1>

    <p>
        @yield("description")
    </p>

    <script>
    console.error(`{{ $exception->getMessage() }}`);
    </script>
</section>

@endsection
