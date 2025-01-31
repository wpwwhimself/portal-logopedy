<x-full-width>
    <header class="flex right but-mobile-down spread middle padded">
        <div class="flex right middle">
            <x-logo />

            <x-button icon="menu">Przeglądaj</x-button>
        </div>

        <x-search-bar />

        <div class="flex right center middle">
            @auth
            <x-button icon="login" :action="route('profile')">Moje konto</x-button>
            @endauth

            @guest
            <x-button class="phantom" icon="login" :action="route('login')">Zaloguj</x-button>
            <x-button icon="account-plus" :action="route('register')">Dołącz za DARMO!</x-button>
            @endguest
        </div>
    </header>
</x-full-width>
