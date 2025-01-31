@extends("layouts.main")

@section("content")

<x-main.line-banner background-class="placeholder">
    Tu będzie wąska reklama. Jeszcze nie wiem, co tu będzie.
</x-main.line-banner>

<x-main.line-banner background-class="placeholder" class="large">
    Tu będzie duży banner
</x-main.line-banner>

<x-main.line-banner background-class="accent background primary">
    <span class="large">
        <b>Kliknij i zapisz się na newsletter</b>,
        żeby nie ominęło Cię żadne logopedyczne wydarzenie!
    </span>
</x-main.line-banner>

<x-main.mid-section />

<x-main.line-banner background-class="accent background secondary">
    <span class="large">
        Oszczędzisz czas i pieniądze!
        Kliknij w baner i dołącz do portalu.
    </span>
</x-main.line-banner>

@endsection
