<?php

use Illuminate\Support\Str;

/**
 * Is it a picture?
 */
function isPicture(string $path): bool
{
    return Str::endsWith(Str::beforeLast($path, "?"), [".jpg", ".jpeg", ".png", ".gif", ".svg"]);
}
