<x-full-width>
    <footer style="padding-bottom: var(--xxl);">
        <div class="flex right but-mobile-down spread middle">
            <x-logo />

            <div class="flex right but-mobile-down middle">
                @foreach (App\Models\StandardPage::visible()->get() as $page)
                <x-button :action="route('standard-page', ['slug' => $page->slug])" class="phantom">{{ $page->name }}</x-button>
                @endforeach
            </div>

            <div class="flex down center middle">
                <span>Zajrzyj na nasze social media:</span>

                <div class="flex right middle">
                    @foreach (App\Models\SocialMedium::visible()->get() as $sm)
                    {!! $sm->icon !!}
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex right but-mobile-down middle">
            Prawa autorskie {{ config("app.name") }}
            &copy; {{ date("Y") }}
        </div>
    </footer>
</x-full-width>
