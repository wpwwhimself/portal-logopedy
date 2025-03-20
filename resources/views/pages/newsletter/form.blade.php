@extends("layouts.main")

@section("title", "Newsletter")

@section("content")

<x-full-width>
    <form action="{{ route('newsletter-'.$mode) }}" method="post">
        @csrf
        <x-side-content-container>
            <x-h :icon="App\Models\NewsletterSubscriber::META['icon']">Zapisz się na newsletter</x-h>

            <x-input type="email"
                name="email"
                label="Adres email"
                icon="email"
                required
            />

            <span class="ghost">Zapisując się, akceptujesz <a href="{{ route('standard-page', ['slug' => 'regulamin']) }}">regulamin newslettera</a>.</span>

            <x-button action="submit" icon="check">Zapisz</x-button>

            <x-slot:side-content>
                <x-hint>
                </x-hint>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
