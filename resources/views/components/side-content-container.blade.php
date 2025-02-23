<div class="side-content-container grid but-halfsize-down">
    <div {{ $attributes->class([
        "content",
        "flex", "down",
        "padded",
    ]) }}>
        {{ $slot }}
    </div>

    <div class="content">
        <div class="flex down padded">
            {{ $sideContent }}
        </div>
    </div>
</div>
