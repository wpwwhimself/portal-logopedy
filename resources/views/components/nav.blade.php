<nav class="flex right center middle hidden padded">
    @foreach ($navLinks as [$label, $route])
    <x-button icon="arrow-right" :action="$route" class="phantom always-light">{{ $label }}</x-button>
    @endforeach
</nav>
