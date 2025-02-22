@extends("layouts.stripped")

@section("title", "Ustawienia")

@section("content")

<x-full-width>
    <form action="{{ route('admin-process-settings') }}" method="post">
        @csrf
        <x-side-content-container>
            <x-model-intro :model="$setting" />

            <x-tile title="Tożsamość strony" title-icon="card-account-details" class="flex down">
                <x-input
                    name="app_name"
                    label="Nazwa"
                    icon="card-account-details"
                    :value="$setting::get('app_name', config('app.name'))"
                />
                @foreach ([
                    ["app_logo_path", "Logo", "image", null],
                    ["app_logo_mono_path", "Logo mono", "image", "Logo monochromatyczne, wyświetlane w nagłówku. W przypadku braku, wyświetlane jest logo zwykłe."],
                    ["app_favicon_path", "Ikona", "postage-stamp", "Ikona wyświetlająca się na karcie w przeglądarce"],
                    ["welcome_banner_path", "Baner powitalny", "image", "Baner wyświetlający się jako pierwszy na stronie głównej"],
                ] as [$name, $label, $icon, $hint])
                    <x-input type="storage_url"
                        :name="$name"
                        :label="$label"
                        :icon="$icon"
                        :value="$setting::get($name)"
                        :hint="$hint"
                    />
                @endforeach
            </x-tile>

            <x-tile title="Metadane" title-icon="card-account-details" class="flex down">
                <p class="ghost">
                    Te ustawienia sterują tym, jak portal wygląda w sieci.
                    Uzupełnienie metadanych pomaga w indeksowaniu i wyszukiwaniu strony.
                </p>

                <x-input type="text"
                    name="metadata_title"
                    label="Tytuł (metadane)"
                    icon="card-account-details"
                    :value="$setting::get('metadata_title')"
                />
                <x-input type="text"
                    name="metadata_author"
                    label="Autor strony"
                    icon="account"
                    :value="$setting::get('metadata_author')"
                />
                <x-input type="TEXT"
                    name="metadata_description"
                    label="Opis"
                    icon="pencil"
                    :value="$setting::get('metadata_description')"
                />
                <x-input type="text"
                    name="metadata_keywords"
                    label="Słowa kluczowe"
                    icon="tag"
                    :value="$setting::get('metadata_keywords')"
                />
                <x-input type="storage_url"
                    name="metadata_image"
                    label="Miniatura"
                    icon="image"
                    :value="$setting::get('metadata_image')"
                />
                <x-input type="TEXT"
                    name="metadata_google_tag_code"
                    label="Kod Google Analytics"
                    icon="map-marker"
                    :value="$setting::get('metadata_google_tag_code')"
                />
            </x-tile>

            <x-tile title="Kolory" title-icon="palette" class="flex down">
                <x-input type="color"
                    name="color_primary"
                    label="Podstawowy"
                    icon="numeric-1"
                    :value="$setting::get('color_primary')"
                />
                <x-input type="color"
                    name="color_secondary"
                    label="Drugorzędny"
                    icon="numeric-2"
                    :value="$setting::get('color_secondary')"
                />
                <x-input type="color"
                    name="color_tertiary"
                    label="Trzeciorzędny"
                    icon="numeric-3"
                    :value="$setting::get('color_tertiary')"
                />
            </x-tile>

            <x-tile title="Blog" :title-icon="App\Models\BlogArticle::META['icon']" clas="flex down">
                <x-input
                    name="blog_name"
                    label="Nazwa bloga"
                    icon="card-account-details"
                    :value="$setting::get('blog_name')"
                />
            </x-tile>

            <x-slot:side-content>
                <x-button action="submit" icon="check">Zapisz</x-button>
                <x-button :action="route('profile')" icon="arrow-left" class="phantom">Wróć</x-button>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
