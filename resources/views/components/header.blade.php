<x-full-width>
    <header class="flex right spread middle">
        <x-logo />

        <x-button icon="menu">Przeglądaj</x-button>

        <x-search-bar />

        <div class="flex right center middle">
            @auth
            <x-button icon="login">Moje konto</x-button>
            @endauth

            @guest
            <x-button phantom icon="login">Zaloguj</x-button>
            <x-button icon="account-plus">Dołącz za DARMO!</x-button>
            @endguest
        </div>
    </header>
</x-full-width>
