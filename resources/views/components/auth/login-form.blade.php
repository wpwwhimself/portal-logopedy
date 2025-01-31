@props([
    "register" => false,
])

<form action="{{ route($register ? 'process-register' : 'process-login') }}"
    method="post"
    class="flex down"
>
    @csrf

    @if ($register)
    <x-input type="text"
        name="name"
        label="Imię i nazwisko"
        icon="card-account-details"
        required
        :autofocus="$register"
    />
    @endif

    <x-input type="email"
        name="email"
        label="Adres email"
        icon="email"
        required
        :autofocus="!$register"
    />

    @if ($register)
    <x-input type="phone"
        name="phone"
        label="Numer telefonu"
        icon="phone"
        required
    />
    @endif

    <x-input type="password"
        name="password"
        label="Hasło"
        icon="key"
        required
    />

    @if ($register)
    <x-input type="password"
        name="password_confirmation"
        label="Powtórz hasło"
        icon="key-link"
        required
    />
    @else
    <x-input type="checkbox"
        name="remember_token"
        label="Zapamiętaj mnie"
        icon="content-save"
    />
    @endif

    @if ($register)
    <x-button action="submit" icon="check">Zarejestruj się</x-button>
    <x-button :action="route('login')" icon="login" class="phantom">Mam już konto</x-button>
    @else
    <x-button action="submit" icon="check">Zaloguj się</x-button>
    <x-button :action="route('register')" icon="account-plus" class="phantom">Utwórz konto</x-button>
    @endif
</form>
