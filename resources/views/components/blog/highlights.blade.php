<div class="blog-highlights flex down">
    {{-- <x-h lvl="2" :icon="$meta['icon']">{{ $title }}</x-h> --}}

    @foreach ($articles as $article)
    <x-blog.article-preview :article="$article" />
    @endforeach

    <x-button :action="route('blog-list')" class="phantom always-light" icon="more">Czytaj więcej</x-button>
</div>
