<div class="side-content-container grid">
    <div {{ $attributes->class([
        "content",
        "flex", "down",
        "padded",
    ]) }}>
        {{ $slot }}
    </div>

    <div class="content flex down padded">
        {{ $sideContent }}
    </div>
</div>
