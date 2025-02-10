<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $incrementing = false;
    protected $primaryKey = "name";
    protected $keyType = "string";
    public $timestamps = false;

    public const META = [
        "label" => "Ustawienia",
        "icon" => "cog",
    ];

    protected $fillable = [
        "name", "value",
    ];

    #region helpers
    public static function get(string $key, $default = null): ?string
    {
        return Setting::find($key)->value ?? $default;
    }
    #endregion
}
