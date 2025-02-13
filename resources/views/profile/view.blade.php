@extends("layouts.main")

@section("title", "Mój profil")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h>{!! auth()->user() !!}</x-h>

        <x-tile title="Moje uprawnienia" :title-icon="App\Models\Role::META['icon']">
            <ul>
                @forelse (auth()->user()->roles as $role)
                <li><b>{{ $role->name }}</b>: {{ $role->description }}</li>
                @empty
                <li>Brak nadanych uprawnień</li>
                @endforelse
            </ul>
        </x-tile>

        @if (auth()->user()->hasRole("technical"))
        <x-tile title="Strefa administratora" title-icon="wizard-hat">
            <div class="grid" style="--col-count: 3;">
                @if (auth()->user()->hasRole("blogger"))
                <x-button :action="route('files-list')" icon="file">Pliki</x-button>
                @endif

                @if (auth()->user()->hasRole("technical"))
                <x-button :action="route('admin-settings')" :icon="App\Models\Setting::META['icon']">{{ App\Models\Setting::META['label'] }}</x-button>
                <x-button :action="route('admin-advert-settings')" :icon="App\Models\AdvertSetting::META['icon']">{{ App\Models\AdvertSetting::META['label'] }}</x-button>
                @endif

                @foreach (App\Http\Controllers\AdminController::SCOPES as $scope => ["model" => $model, "role" => $role])
                @if (auth()->user()->hasRole($role))
                <x-button :action="route('admin-list-model', ['model' => $scope])" :icon="$model::META['icon']">{{ $model::META['label'] }}</x-button>
                @endif
                @endforeach
            </div>
        </x-tile>
        @endif

        <x-slot:side-content>
            <x-button :action="route('change-password')" icon="key-change" class="phantom">Zmień hasło</x-button>
            <x-button :action="route('logout')" icon="logout">Wyloguj się</x-button>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
