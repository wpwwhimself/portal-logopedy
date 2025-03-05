@props([
    "placeholder" => "Jakiego szkolenia szukasz?",
    "model" => "courses"
])

<search>
    <form action="{{ route('front-list', ["model_name" => $model]) }}" class="grid middle rounded padded">
        <input type="text" placeholder="{{ $placeholder }}"
            name="q"
            value="{{ request("q") }}"
        >

        <button type="submit" class="rounded always-light accent background secondary interactive">
            @svg("mdi-magnify")
        </button>
    </form>
</search>
