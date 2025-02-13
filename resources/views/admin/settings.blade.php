@extends("layouts.admin")

@section("title", "Ustawienia")

@section("content")


<x-full-width>
    <form action="{{ route('admin-process-settings') }}" method="post">
        @csrf
        <x-side-content-container>
            <x-h :icon="App\Models\Setting::META['icon']">{{ App\Models\Setting::META['label'] }}</x-h>

            <x-tile title="Tożsamość strony" title-icon="card-account-details" class="flex down">
                <x-input
                    name="app_name"
                    label="Nazwa"
                    icon="card-account-details"
                    :value="$setting::get('app_name', config('app.name'))"
                />
                <x-input
                    name="app_logo_path"
                    label="Logo"
                    icon="image"
                    :value="$setting::get('app_logo_path', asset('img/logo.svg'))"
                />
                <x-input
                    name="app_favicon_path"
                    label="Ikona"
                    icon="postage-stamp"
                    :value="$setting::get('app_favicon_path')"
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
                <x-button action="submit" form="settings" icon="check">Zapisz</x-button>
                <x-button :action="route('profile')" icon="arrow-left" class="phantom">Wróć</x-button>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
