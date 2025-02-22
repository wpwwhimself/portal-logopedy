@props([
    "article",
])

<x-tile :action="route('blog-view', ['slug' => $article->slug])"
    class="blog-article-preview padded"
    no-border
>
    @if ($article->banner_path)
    <div class="banner flex right center middle rounded">
        <img src="{{ $article->banner_path }}" alt="{{ $article->name }}">
    </div>
    @endif

    <div class="content">
        <span class="pre-heading ghost">{{ $article->created_at->diffForHumans() }}</span>

        <x-h lvl="3" class="accent secondary">{{ $article->name }}</x-h>

        <p>{{ Str::words($article->header_paragraph, 25) }}</p>
    </div>
</x-tile>
