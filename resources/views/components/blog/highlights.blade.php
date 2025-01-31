<div class="blog-highlights">
    <h3>Blog Portal Logopedyczny</h3>

    <div class="flex down big-gap">
        @foreach ([1,2,3] as $article)
        <x-blog.article-preview :article="$article" />
        @endforeach
    </div>
</div>
