@props([
    "article",
])

<div class="blog-article-preview">
    <span class="pre-heading ghost">Testowy pre-nagłówek</span>

    <h2>Testowy nagłówek</h2>

    @php $words = "Treść testowa Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, laborum corporis, magni perferendis molestias accusantium sapiente enim ducimus totam asperiores quia! Ratione modi nam commodi atque, rerum in facere necessitatibus."; @endphp
    <p>{{ Str::words($words, 25) }}</p>
</div>
