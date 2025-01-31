@props(['status'])

<div class="alert {{ $status }} animatable">
    @svg("mdi-".($status == "success" ? "check-circle" : "alert-circle"))

    {{ session($status) }}
</div>
