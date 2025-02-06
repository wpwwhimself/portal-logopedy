@props([
    "name",
    "value" => null,
])

<div>
    <div class="main-container">
        <div class="editor-container editor-container_classic-editor editor-container_include-style" id="editor-container">
            <div class="editor-container__editor">
                <textarea name="{{ $name }}" class="ckeditor">
                    {!! $value !!}
                </textarea>
            </div>
        </div>
    </div>
</div>
