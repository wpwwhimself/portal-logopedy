@extends("layouts.main")

@section("title", $article->name)
@section("subtitle", App\Models\Setting::get("blog_name"))

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h>{!! $article !!}</x-h>
        <span class="ghost">
            {!! $article->creator !!}
            |
            {{ $article->created_at->diffForHumans() }}
        </span>

        @if ($article->banner_path)
        <img src="{{ $article->banner_path }}" alt="{{ $article->name }}">
        @endif

        <big class="ghost">{{ $article->header_paragraph }}</big>

        {!! $article->content !!}

        @if ($article->outside_link)
        <x-button :action="$article->outside_link" icon="link" class="accent background secondary">Więcej informacji</x-button>
        @endif

        <x-slot:side-content>
            <x-blog.highlights title="Polecane artykuły" :except-id="$article->id" />
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
