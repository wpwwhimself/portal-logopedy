@extends("layouts.docs")

@section("title", "Dokumentacja")

@section("doc")

{!! \Illuminate\Mail\Markdown::parse($doc) !!}

@endsection
