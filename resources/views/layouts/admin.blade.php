@extends("layouts.base")

@section("extra_head")
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section("header")
<x-header hide-browsing />
@endsection

@section("body")

@yield("content")

@endsection
