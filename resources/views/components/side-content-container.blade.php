<div class="side-content-container grid">
    <div {{ $attributes->class([
        "content",
        "padded",
    ]) }}>
        {{ $slot }}
    </div>

    <div class="content padded">
        {{ $sideContent }}
    </div>
</div>
