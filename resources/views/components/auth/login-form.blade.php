@props([
    "mode" => "login",
])

<form action="{{ route('process-'.$mode) }}"
    method="post"
    class="flex down"
>
    @csrf

    @if ($mode == "reset-password")
    <input type="hidden" name="token" value="{{ request('token') }}">
    @endif

    @if ($mode == "register")
    <x-input type="select"
        name="role"
        label="Typ konta"
        icon="account"
        :options="App\Models\Role::ACCOUNT_TYPES"
    />
    <x-input type="text"
        name="name"
        label="Imię i nazwisko"
        icon="card-account-details"
        required
        autofocus
    />
    @endif

    @if (in_array($mode, ["login", "register", "reset-password"]))
    <x-input type="email"
        name="email"
        label="Adres email"
        icon="email"
        required
        :autofocus="$mode == 'login'"
        :autocomplete="$mode == 'login' ? 'off' : null"
    />
    @endif

    @if ($mode == "register")
    <x-input type="tel"
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

    @if (in_array($mode, ["register", "change-password", "reset-password"]))
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
        value="1"
    />
    @endif

    @if ($mode == "register")
    <x-input type="number"
        name="proof"
        label="Jesteś robotem? Ile jest sylab w słowie 'logopeda'?"
        icon="robot-confused"
        required
    />
    @endif

    @if (in_array($mode, ["login", "register"]))
        @if ($mode == "register")
        <x-button action="submit" icon="check">Zarejestruj się</x-button>
        <x-button :action="route('login')" icon="login" class="phantom">Mam już konto</x-button>
        @else
        <x-button action="submit" icon="check">Zaloguj się</x-button>
        <x-button :action="route('register')" icon="account-plus" class="phantom">Utwórz konto</x-button>
        <x-button :action="route('forgot-password')" icon="key-change" class="phantom">Zapomniałem hasła</x-button>
        @endif
    @elseif (in_array($mode, ["change-password", "reset-password"]))
    <x-button action="submit" icon="check">Zmień hasło</x-button>
    @endif
</form>
