@extends("layouts.main")

@section("title", "Rejestracja")

@section("content")

<x-full-width>
    <x-side-content-container>
        <x-h icon="account-plus">Rejestracja</x-h>

        @unless (request("role"))
        <p>Wybierz rodzaj konta, jakie chcesz założyć:</p>
        <div class="flex right spread and-cover">
            @foreach (App\Models\Role::ACCOUNT_TYPES as $role => $label)
            <x-button :action="route('register', ['role' => $role])">
                <div class="flex down middle">
                    <span class="large">{{ $label }}</span>
                    <span>{{ App\Models\Role::find($role)->description }}</span>
                </div>
            </x-button>
            @endforeach
        </div>
        @else
        <x-auth.login-form mode="register" />
        @endunless

        <x-button :action="route('login')" icon="login" class="phantom">Mam już konto</x-button>

        <x-slot:side-content>
            <x-hint title="Co zyskasz z rejestracji?">
                <p>
                    Rejestracja pozwoli Ci oceniać kursy i szkolenia.
                    Jeśli zarejestrujesz się jako twórca, będziesz mógł dodawać własne kursy i reklamować swoje szkolenia.
                    Konto pozwala również na zapisanie się do naszego newslettera.
                </p>
            </x-hint>
        </x-slot:side-content>
    </x-side-content-container>
</x-full-width>

@endsection
