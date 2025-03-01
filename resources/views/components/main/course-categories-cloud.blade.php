<div {{ $attributes }}>
    <h4 class="accent primary">Kursy i szkolenia według kategorii:</h4>

    <div class="flex right center middle">
        @foreach ($categories as $category)
        <x-button :action="route('front-list', ['model_name' => 'courses', 'category' => $category])" class="phantom accent secondary">
            {{ $category }}
        </x-button>
        @endforeach
    </div>
</div>
