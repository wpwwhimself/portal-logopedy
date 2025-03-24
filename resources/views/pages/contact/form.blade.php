@extends("layouts.main")

@section("title", "Formularz kontaktowy")

@section("content")

<x-full-width>
    <form action="{{ route('contact-form-process') }}" method="post">
        @csrf
        <x-side-content-container>
            <x-h icon="email">Napisz do nas</x-h>

            <x-h lvl="3" icon="card-account-details">Twoje dane kontaktowe</x-h>

            <x-input
                name="name"
                label="Imię i nazwisko"
                icon="account"
                required
            />
            <x-input
                name="company"
                label="Nazwa firmy"
                icon="domain"
            />
            <x-input type="email"
                name="email"
                label="Twój adres email"
                icon="email"
                required
            />
            <x-input type="tel"
                name="phone"
                label="Numer telefonu"
                icon="phone"
            />

            <x-h lvl="3" icon="pencil">Wiadomość</x-h>

            <x-input type="TEXT"
                name="message_content"
                label="Treść"
                icon="pencil"
                required
            />

            <x-h lvl="3" icon="lock">Pozostałe</x-h>
            <x-input type="number"
                name="proof"
                label="Jesteś robotem? Ile jest sylab w słowie 'szkolenie'?"
                icon="robot-confused"
                required
            />

            <x-button action="submit" icon="send-variant">Wyślij</x-button>

            <x-slot:side-content>
                <x-hint>
                    <p>Nie chcesz skorzystać z formularza?</p>

                    <x-button action="mailto:{{ env('MAIL_FROM_ADDRESS') }}"
                        icon="send-variant"
                        class="phantom"
                    >
                        Napisz maila ręcznie
                    </x-button>
                </x-hint>
            </x-slot:side-content>
        </x-side-content-container>
    </form>
</x-full-width>

@endsection
