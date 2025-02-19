@props([
    "article",
])

<a href="{{ route("blog-view", ["slug" => $article->slug]) }}" {{ $attributes->class([
    "blog-article-preview",
    "interactive", "shift-right",
    "padded",
]) }}>
    @if ($article->banner_path)
    <div class="banner flex right center middle">
        <img src="{{ $article->banner_path }}" alt="{{ $article->name }}">
    </div>
    @endif

    <div class="content">
        <span class="pre-heading ghost">{{ $article->created_at->diffForHumans() }}</span>

        <x-h lvl="3">{{ $article->name }}</x-h>

        <p>{{ Str::words($article->header_paragraph, 25) }}</p>
    </div>
</a>
