@props([
    "hideBrowsing" => false,
])

<x-full-width>
    <header class="flex right but-mobile-down spread middle padded">
        <div class="flex right middle">
            <x-logo />

            @unless ($hideBrowsing) <x-button icon="menu">Przeglądaj</x-button> @endunless
        </div>

        @unless ($hideBrowsing) <x-search-bar /> @endunless

        <div class="flex right center middle">
            <x-button icon="theme-light-dark" class="phantom interactive" onclick="toggleTheme()" />

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
