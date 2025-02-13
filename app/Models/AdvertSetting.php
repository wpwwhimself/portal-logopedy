<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Wildside\Userstamps\Userstamps;

class AdvertSetting extends Model
{
    use Userstamps, CanBeStringified;

    public $incrementing = false;
    protected $primaryKey = "name";
    protected $keyType = "string";
    const CREATED_AT = null;

    public const META = [
        "label" => "Reklamy",
        "icon" => "bullhorn",
        "description" => "Ustawienia pozwalają na zarządzanie wyświetlanymi reklamami. Na stronie głównej znajdują się banery, które można skonfigurować, żeby wyświetlały własne treści.",
    ];

    protected $fillable = [
        "value",
    ];

    #region helpers
    public static function get(string $type, string $key, $default = null): ?string
    {
        return AdvertSetting::where("ad_type", $type)
            ->where("name", $key)
            ->first()
            ?->value ?? $default;
    }

    public static function canBeSeen(string $type): bool
    {
        return self::get($type, "visible") > 1 - Auth::check();
    }
    #endregion
}
