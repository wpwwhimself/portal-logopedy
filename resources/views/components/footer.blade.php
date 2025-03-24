<x-full-width>
    <footer style="padding-bottom: var(--xxl);">
        <div class="flex right but-mobile-down spread middle">
            <x-logo />

            <div class="flex right but-mobile-down middle">
                @foreach (App\Models\StandardPage::visible()->get() as $page)
                <x-button :action="route('standard-page', ['slug' => $page->slug])" class="phantom accent primary">{{ $page->name }}</x-button>
                @endforeach

                <x-button :action="route('contact-form')" class="phantom accent primary">Kontakt</x-button>
            </div>

            <div class="flex right middle">
                @foreach (App\Models\SocialMedium::visible()->get() as $sm)
                {!! $sm->icon !!}
                @endforeach
            </div>
        </div>

        <div class="flex right but-mobile-down middle accent primary">
            Prawa autorskie {{ App\Models\Setting::get("app_name", config("app.name")) }}
            &copy; {{ date("Y") }}
        </div>
    </footer>
</x-full-width>
