<div class="blog-highlights">
    <x-h lvl="2" :icon="$meta['icon']">{{ $title }}</x-h>

    <x-tile class="flex down big-gap" no-border>
        @foreach ($articles as $article)
        <x-blog.article-preview :article="$article" />
        @endforeach

        <x-button :action="route('blog-list')" class="phantom" icon="more">Czytaj więcej</x-button>
    </x-tile>
</div>
