@props([
    "placeholder" => "Jakiego szkolenia szukasz?",
])

<search>
    <form action="" class="grid middle rounded padded">
        <input type="text" placeholder="{{ $placeholder }}">

        <button type="submit" class="rounded accent background secondary">
            @svg("mdi-magnify")
        </button>
    </form>
</search>
