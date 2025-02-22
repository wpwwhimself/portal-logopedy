@props([
    "hideBrowsing" => false,
])

<x-full-width class="accent background secondary">
    <header class="flex right but-mobile-down spread middle padded">
        <x-logo mono />

        <div class="flex right middle">
            @unless ($hideBrowsing) <x-button icon="menu" class="always-light phantom bordered">Przeglądaj</x-button> @endunless
        </div>

        @unless ($hideBrowsing) <x-search-bar /> @endunless

        <div class="flex right center middle">
            <x-button icon="theme-light-dark" class="always-light phantom interactive" onclick="toggleTheme()" />

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
