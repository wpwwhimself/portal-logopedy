@extends("layouts.base")

@section("extra_head")
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section("header")
<x-header />
@endsection

@section("body")

@yield("content")

@endsection
