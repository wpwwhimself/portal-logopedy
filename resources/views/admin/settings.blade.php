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

            <x-tile title="Kolory" title-icon="palette" class="grid" style="--col-count: 2;">
                <x-tile title="Tryb jasny" title-icon="weather-sunny" title-lvl="3" class="flex down" no-border>
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

                <x-tile title="Tryb ciemny" title-icon="weather-night" title-lvl="3" class="flex down" no-border>
                    <x-input type="color"
                        name="color_primary_dark"
                        label="Podstawowy"
                        icon="numeric-1"
                        :value="$setting::get('color_primary_dark')"
                    />
                    <x-input type="color"
                        name="color_secondary_dark"
                        label="Drugorzędny"
                        icon="numeric-2"
                        :value="$setting::get('color_secondary_dark')"
                    />
                    <x-input type="color"
                        name="color_tertiary_dark"
                        label="Trzeciorzędny"
                        icon="numeric-3"
                        :value="$setting::get('color_tertiary_dark')"
                    />
                </x-tile>
            </x-tile>

            <x-tile title="Strona główna" title-icon="billboard" class="flex down">
                <x-tile title="Nawigacja" title-icon="routes" title-lvl="3" class="flex down" no-border>
                    <x-input type="JSON" :column-types="[
                        'Model' => 'text',
                        'Etykieta' => 'text',
                    ]"
                        name="nav_labels"
                        label="Etykiety nawigacji"
                        icon="routes"
                        :value="json_decode($setting::get('nav_labels'), true)"
                    />

                    <x-input
                        name="newsletter_button_text"
                        label="Treść na przycisku do newslettera"
                        icon="email"
                        :value="$setting::get('newsletter_button_text')"
                    />
                </x-tile>

                <x-tile title="Sekcja środkowa" title-icon="image" title-lvl="3" class="flex down" no-border>
                    @for ($i = 1; $i <= 6; $i++)
                    <x-input type="storage_url"
                        name="main_tile_{{ $i }}_icon_path"
                        label="Ikona kafelka {{ $i }}"
                        icon="image"
                        :value="$setting::get('main_tile_'.$i.'_icon_path')"
                    />
                    @endfor
                </x-tile>
            </x-tile>

            <x-tile title="Kursy" :title-icon="App\Models\Course::META['icon']" class="flex down">
                <x-input
                    name="course_heading"
                    label="Nagłówek"
                    hint="Nagłówek na górze listingu kursów"
                    icon="text-short"
                    :value="$setting::get('course_heading')"
                />
                <x-input type="JSON"
                    :column-types="[
                        'Kolejność' => 'number',
                        'Treść' => 'TEXT',
                        'Link do ikony' => 'storage_url',
                    ]"
                    name="course_bulletpoints"
                    label="Bullet-pointy"
                    icon="format-list-bulleted"
                    :value="json_decode($setting::get('course_bulletpoints'), true)"
                    hint="Ikony z informacjami na początku listingu kursów"
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
