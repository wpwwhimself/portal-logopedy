<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;

class BlogArticle extends Model
{
    use Userstamps, CanBeStringified;

    public const META = [
        "label" => "Artykuły",
        "icon" => "newspaper",
        "description" => "Wpisy do bloga. Najnowsze artykuły wyświetlane są na stronie głównej, skąd można przejść do ich pełnej listy.",
    ];

    protected $fillable = [
        "name", "visible", "order",
        "banner_path",
        "header_paragraph",
        "content",
        "outside_link",
    ];

    public const FIELDS = [
        "banner_path" => [
            "type" => "storage_url",
            "label" => "Baner",
            "icon" => "image",
        ],
        "header_paragraph" => [
            "type" => "TEXT",
            "label" => "Akapit początkowy",
            "icon" => "text-short",
        ],
        "content" => [
            "type" => "HTML",
            "label" => "Treść",
            "icon" => "text-long",
        ],
        "outside_link" => [
            "type" => "url",
            "label" => "Link zewnętrzny",
            "icon" => "link",
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

    public function scopeRecent($query, string $except_id = null)
    {
        return $query->where("visible", ">", 1 - Auth::check())
            ->orderByDesc("updated_at")
            ->where("id", "!=", $except_id)
            ->limit(3);
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
