<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use CanBeStringified;

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
