@props(['status'])

<x-tile background-class="alert shaded accent {{ $status }} interactive"
    class="flex right middle"
>
    @svg("mdi-".($status == "success" ? "check-circle" : "alert-circle"))

    {{ session($status) }}
</x-tile>
