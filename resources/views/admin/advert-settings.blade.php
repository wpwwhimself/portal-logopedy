@extends("layouts.admin")

@section("title", "Ustawienia")

@section("content")


<x-full-width>
    <form action="{{ route('admin-process-advert-settings') }}" method="post">
        @csrf
        <x-side-content-container>
            <x-model-intro :model="$setting" />

            <x-tile title="Wąski baner" title-icon="minus" class="flex down">
                <p class="ghost">
                    Pierwszy na stronie głównej, tuż nad dużym banerem. Może zawierać tylko tekst.
                </p>
                @php $type = "thin"; @endphp

                <x-input type="select"
                    name="{{ $type }}%visible"
                    label="Widoczny"
                    icon="eye"
                    :options="App\Http\Controllers\AdminController::VISIBILITIES"
                    :value="$setting::get($type, 'visible')"
                />
                <x-input type="TEXT"
                    name="{{ $type }}%content"
                    label="Treść"
                    icon="pencil"
                    :value="$setting::get($type, 'content')"
                />
                <x-input type="color"
                    name="{{ $type }}%background-color"
                    label="Kolor tła"
                    icon="palette"
                    :value="$setting::get($type, 'background-color')"
                />
                <x-input type="checkbox"
                    name="{{ $type }}%white_text"
                    label="Biały tekst"
                    icon="palette"
                    value="1"
                    :checked="(boolean) $setting::get($type, 'white_text')"
                />
                <x-input type="url"
                    name="{{ $type }}%link"
                    label="Link"
                    icon="link"
                    :value="$setting::get($type, 'link')"
                />
            </x-tile>

            <x-tile title="Duży baner" title-icon="panorama-horizontal" class="flex down">
                <p class="ghost">
                    Największy na stronie, w centralnym punkcie.
                </p>
                @php $type = "big"; @endphp

                <x-input type="select"
                    name="{{ $type }}%visible"
                    label="Widoczny"
                    icon="eye"
                    :options="App\Http\Controllers\AdminController::VISIBILITIES"
                    :value="$setting::get($type, 'visible')"
                />
                <x-input type="url"
                    name="{{ $type }}%image_path"
                    label="Obraz"
                    icon="image"
                    :value="$setting::get($type, 'image_path')"
                />
                <x-input type="url"
                    name="{{ $type }}%link"
                    label="Link"
                    icon="link"
                    :value="$setting::get($type, 'link')"
                />
            </x-tile>

            <x-tile title="Boczne okienko" title-icon="dock-right" class="flex down">
                <p class="ghost">
                    Znajduje się po prawej stronie strony głównej, pod blogiem.
                </p>
                @php $type = "side"; @endphp

                <x-input type="select"
                    name="{{ $type }}%visible"
                    label="Widoczny"
                    icon="eye"
                    :options="App\Http\Controllers\AdminController::VISIBILITIES"
                    :value="$setting::get($type, 'visible')"
                />
                <x-input type="url"
                    name="{{ $type }}%image_path"
                    label="Obraz"
                    icon="image"
                    :value="$setting::get($type, 'image_path')"
                />
                <x-input type="url"
                    name="{{ $type }}%link"
                    label="Link"
                    icon="link"
                    :value="$setting::get($type, 'link')"
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
