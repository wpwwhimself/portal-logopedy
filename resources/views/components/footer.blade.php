<x-full-width>
    <footer style="padding-bottom: var(--xxl);">
        <div class="flex right spread middle">
            <x-logo />

            <div class="flex right middle">
                <x-button class="phantom">Kontakt</x-button>
                <x-button class="phantom">Polityka Prywatności</x-button>
                <x-button class="phantom">Regulamin</x-button>
                <x-button class="phantom">FAQ</x-button>
            </div>

            <div class="flex down center">
                <span>Zajrzyj na nasze social media:</span>

                <div class="flex right middle">

                </div>
            </div>
        </div>

        <p>
            Prawa autorskie {{ config("app.name") }}
            &copy; {{ date("Y") }}
        </p>
    </footer>
</x-full-width>
