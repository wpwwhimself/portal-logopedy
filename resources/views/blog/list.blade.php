@extends("layouts.main")

@section("title", App\Models\Setting::get("blog_name"))

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h :icon="App\Models\BlogArticle::META['icon']">{!! App\Models\Setting::get("blog_name") !!}</x-h>

        @forelse ($articles as $article)
        <x-blog.article-preview :article="$article" />
        @empty
        <div class="ghost">Brak artykułów</div>
        @endforelse

        {{ $articles->links() }}

        <x-slot:side-content>

        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
