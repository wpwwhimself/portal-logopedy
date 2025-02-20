@props([
    "action" => null,
])

<x-button class="accent background tertiary" :action="$action">
    {{ $slot }}
</x-button>
