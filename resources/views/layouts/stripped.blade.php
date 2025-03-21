@extends("layouts.base")

@section("header")
<x-header hide-browsing />
@endsection

@section("body")

<x-full-width>
    @yield("content")
</x-full-width>

@endsection
