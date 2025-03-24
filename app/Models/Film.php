<?php

namespace App\Models;

use App\CanBeReviewed;
use App\CanBeSorted;
use App\CanBeStringified;
use App\HasIconedAttributes;
use App\HasStandardScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;

class Film extends Model
{
    use Userstamps, CanBeStringified, SoftDeletes;

    public const META = [
        "label" => "Filmy i wideopodcasty",
        "icon" => "movie-open",
        "description" => "Lista filmów i wideopodcastów. Każda pozycja posiada link do filmu oraz jego krótki opis.",
    ];

    protected $fillable = [
        "name", "visible", "order",
        "categories",
        "description",
        "keywords",
        "thumbnail_path",
        "link",
    ];

    public const FIELDS = [
        "categories" => [
            "type" => "JSON",
            "column-types" => [
                "Nazwa" => "text",
            ],
            "label" => "Kategorie",
            "icon" => "shape",
            "required" => true,
            "autofillFrom" => ["entmgr-list-categories", "films"],
        ],
        "description" => [
            "type" => "TEXT",
            "label" => "Opis",
            "icon" => "pencil",
        ],
        "keywords" => [
            "type" => "JSON",
            "column-types" => [
                "Fraza" => "text",
            ],
            "icon" => "tag",
            "label" => "Słowa kluczowe",
        ],
        "thumbnail_path" => [
            "type" => "url",
            "label" => "Miniatura",
            "icon" => "image",
        ],
        "link" => [
            "type" => "url",
            "label" => "Link",
            "hint" => "Bezpośredni link do filmu.",
            "icon" => "link",
        ],
    ];

    use CanBeSorted;

    public const FILTERS = [
        "categories" => [
            "compare-using" => "field",
            "discr" => "categories",
            "operator" => "any",
        ],
        "keywords" => [
            "compare-using" => "field",
            "discr" => "keywords",
            "operator" => "any",
        ],
    ];

    #region scopes
    use HasStandardScopes;
    #endregion

    #region attributes
    use HasIconedAttributes;

    protected function casts(): array
    {
        return [
            "categories" => "collection",
            "keywords" => "collection",
        ];
    }

    public function canBeSeen(): bool
    {
        return $this->visible > 1 - Auth::check();
    }

    public function fullCategoryPretty(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->categories?->first() . (($this->categories?->count() > 1)
                ? " (+".($this->categories->count() - 1).")" . view("components.icon", ['name' => "chevron-down", "hint" => $this->categories->join("<br>")])->render()
                : ""
            ),
        );
    }

    public function youtubeId(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::of($this->link)?->match("/v=(.{11})/"),
        );
    }
    #endregion

    #region relations
    use CanBeReviewed;
    #endregion
}
