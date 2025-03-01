<?php

namespace App\Models;

use App\CanBeStringified;
use App\HasStandardScopes;
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
        "type",
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
        "type" => [
            "type" => "text",
            "label" => "Typ artykułu",
            "icon" => "shape",
            "required" => true,
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

    public const CONNECTIONS = [
        // "industries" => [
        //     "model" => Industry::class,
        //     "mode" => "many",
        // ],
    ];

    #region scopes
    use HasStandardScopes;
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

    #region relations
    public function industries()
    {
        return $this->morphToMany(Industry::class, "industriable");
    }
    #endregion
}
