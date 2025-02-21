<div class="flex down">
    @foreach ($docs as $group => $articles)
        <x-h lvl="2" icon="folder">{{ $group }}</x-h>

        @foreach ($articles as $label => $path)
        <x-button icon="book"
            :action="route('docs-view', ['slug' => $path])"
            :class="Route::current()->parameter('slug') != $path ? 'phantom' : ''"
        >
            {{ $label }}
        </x-button>
        @endforeach
    @endforeach

    <x-button :action="route('profile')" icon="arrow-left" class="phantom">Wróć do profilu</x-button>
</div>
