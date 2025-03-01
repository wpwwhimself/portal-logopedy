<form id="filters" class="flex down">
    <x-tile
        title="Sortuj"
        title-lvl="3"
        title-icon="sort"
        expandable
        class="flex down"
        :activated="request()->has('sort')"
    >
        @foreach ($sorts as $name => $srt)
        <div class="grid middle">
            <input type="radio" name="sort"
                id="sort-{{ $name }}-asc"
                value="{{ $name }}"
                {{ request()->get("sort") == $name ? "checked" : "" }}
            />
            <label for="sort-{{ $name }}-asc">{{ $srt["label"] }} rosnąco</label>
        </div>
        <div class="grid middle">
            <input type="radio" name="sort"
                id="sort-{{ $name }}-desc"
                value="-{{ $name }}"
                {{ request()->get("sort") == "-{$name}" ? "checked" : "" }}
            />
            <label for="sort-{{ $name }}-desc">{{ $srt["label"] }} malejąco</label>
        </div>
        @endforeach
    </x-tile>

    @foreach ($filters as $name => $flt)
    <x-tile
        :title="$flt['label'] ?? $fields[$name]['label']"
        :title-lvl="3"
        :title-icon="$flt['icon'] ?? $fields[$name]['icon']"
        expandable
        class="flex down"
        :activated="request()->has($name)"
    >
        @if ($flt == "list-from-db")
        <x-button icon="filter-off" onclick="resetFilters(this)" class="accent background secondary interactive small">Wyczyść</x-button>

        @foreach ($model::classes($name) as $class)
        <div class="grid middle">
            <input type="checkbox"
                id="filters-{{ $name }}-{{ $class }}"
                name="{{ $name }}[]"
                value="{{ $class }}"
                {{ in_array($class, request()->get($name, [])) ? "checked" : "" }}
            />
            <label for="filters-{{ $name }}-{{ $class }}">{{ $class ?? "bd." }}</label>
        </div>
        @endforeach
        @endif
    </x-tile>
    @endforeach

    <div class="flex right spread and-cover">
        <x-button action="submit" icon="filter">Zmień filtry</x-button>
        @if (request()->all())
        <x-button :action="route('front-list', ['model_name' => $modelName])" icon="filter-off" class="accent background secondary">Wyczyść</x-button>
        @endif
    </div>
</form>
