<div class="blog-highlights flex down">
    {{-- <x-h lvl="2" :icon="$meta['icon']">{{ $title }}</x-h> --}}

    @forelse ($articles as $article)
    <x-blog.article-preview :article="$article" />
    @empty
    <div class="ghost flex right center middle">
        {{ App\Models\Setting::get("blog_name") }} nie ma na razie żadnych wpisów
    </div>
    @endforelse

    @if (Route::current()->getName() == "blog-view")
    <x-button :action="route('blog-list')" class="phantom" icon="arrow-left">Wróć</x-button>
    @else
    <x-button :action="route('blog-list')" class="phantom always-light pin-right" icon="more">Czytaj więcej</x-button>
    @endif
</div>
