@props(['status'])

<x-tile class="alert shaded accent {{ $status }} interactive">
    <div class="flex right middle">
        @svg("mdi-".($status == "success" ? "check-circle" : "alert-circle"))

        {{ session($status) }}
    </div>
</x-tile>
