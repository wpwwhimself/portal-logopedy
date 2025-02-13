<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StandardPage extends Model
{
    use CanBeStringified;

    public const META = [
        "label" => "Strony standardowe",
        "icon" => "script-text",
        "description" => "Podstrony aplikacji, stanowiące dodatkową treść portalu. Ich pełna lista wyświetla się w stopce strony.",
    ];

    protected $fillable = [
        "name", "content",
        "visible", "order",
    ];

    public const FIELDS = [
        "content" => [
            "type" => "HTML",
            "label" => "Treść",
            "icon" => "pencil",
        ],
    ];

    #region scopes
    public function scopeForAdminList($query)
    {
        return $query->orderBy("order")
            ->orderBy("name");
    }

    public function scopeVisible($query)
    {
        return $query->where("visible", ">", 1 - Auth::check())
            ->orderBy("order")
            ->orderBy("name");
    }
    #endregion

    #region attributes
    /**
     * checks if current user can see this page
     */
    public function canBeSeen(): bool
    {
        return $this->visible > 1 - Auth::check();
    }

    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::slug($this->name),
        );
    }
    #endregion
}
