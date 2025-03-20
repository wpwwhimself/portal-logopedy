<form id="filters" class="flex down nowrap">
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
            <label for="sort-{{ $name }}-asc">{{ $srt["label"] }} <x-icon name="sort-ascending" /></label>
        </div>
        <div class="grid middle">
            <input type="radio" name="sort"
                id="sort-{{ $name }}-desc"
                value="-{{ $name }}"
                {{ request()->get("sort") == "-{$name}" ? "checked" : "" }}
            />
            <label for="sort-{{ $name }}-desc">{{ $srt["label"] }} <x-icon name="sort-descending" /></label>
        </div>
        @endforeach
    </x-tile>

    @auth
    @foreach ($filters as $name => $flt)
    <x-tile
        :title="$flt['label'] ?? $fields[$name]['label']"
        :title-lvl="3"
        :title-icon="$flt['icon'] ?? $fields[$name]['icon']"
        expandable
        class="flex down nowrap scrollable"
        :activated="request()->has($name)"
    >
        <x-button icon="filter-off" onclick="resetFilters(this)" class="accent background secondary interactive small">Wyczyść</x-button>

        @foreach ($flt["options"] ?? $model::classes($name) as $label => $level)
        <div class="grid middle">
            <input type="{{ ($flt['mode'] ?? 'many') == 'one' ? 'radio' : 'checkbox' }}"
                id="filters-{{ $name }}-{{ $level }}"
                name="{{ $name }}{{ ($flt['mode'] ?? 'many') == 'one' ? '' : '[]' }}"
                value="{{ $level }}"
                {{ (request()->has($name) && (is_array(request()->get($name)) ? in_array($level, request()->get($name, [])) : request()->get($name) == $level))
                    ? "checked"
                    : ""
                }}
            />
            <label for="filters-{{ $name }}-{{ $level }}">{{ $label ?: "bd." }}</label>
        </div>
        @endforeach
    </x-tile>
    @endforeach
    @else
    <x-tile>
        <span>Zaloguj się, aby móc dokładniej filtrować wyniki</span>
    </x-tile>
    @endauth

    <div class="flex right spread and-cover">
        <x-button action="submit" icon="filter">Zmień filtry</x-button>
        @if (request()->all())
        <x-button :action="route('front-list', ['model_name' => $modelName])" icon="filter-off" class="accent background secondary">Wyczyść</x-button>
        @endif
    </div>
</form>
