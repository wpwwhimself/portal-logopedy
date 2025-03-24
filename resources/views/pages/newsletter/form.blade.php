@extends("layouts.main")

@section("title", "Newsletter")

@section("content")

<x-full-width>
    <form action="{{ route('newsletter-'.$mode) }}" method="post">
        @csrf
        <x-side-content-container>
            <x-h :icon="App\Models\NewsletterSubscriber::META['icon']">
                @switch ($mode)
                    @case ("subscribe")
                    Zapisz się na newsletter
                    @break

                    @case ("unsubscribe")
                    Wypisz się z newslettera
                    @break
                @endswitch
            </x-h>

            <x-input type="email"
                name="email"
                label="Adres email"
                icon="email"
                required
            />

            @if ($mode == "subscribe")
            <span class="ghost">Zapisując się, akceptujesz <a href="{{ route('standard-page', ['slug' => 'regulamin']) }}">regulamin newslettera</a>.</span>
            @endif

            <x-button action="submit" icon="check">Zapisz</x-button>

            <x-slot:side-content>
                <x-hint>
                </x-hint>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
