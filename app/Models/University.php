<?php

namespace App\Models;

use App\CanBeReviewed;
use App\CanBeSorted;
use App\CanBeStringified;
use App\HasIconedAttributes;
use App\HasStandardScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;

class University extends Model
{
    use Userstamps, CanBeStringified;

    public const META = [
        "label" => "Uczelnie",
        "icon" => "school",
        "description" => "Lista uczelni. Każda pozycja przechowuje informacje o uczelni. Te informacje mogą pochodzić z kursu, kiedy automatyzacja sklasyfikuje ją jako takiego.",
    ];

    protected $fillable = [
        "name", "visible", "order",
        "categories",
        "description",
        "keywords",
        "thumbnail_path", "image_paths",
        "link",
        "location",
        "cost",
    ];

    public const FIELDS = [
        "categories" => [
            "type" => "JSON",
            "column-types" => [
                "Nazwa" => "text",
            ],
            "label" => "Kategorie",
            "icon" => "shape",
        ],
        "description" => [
            "type" => "HTML",
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
        "image_paths" => [
            "type" => "JSON",
            "column-types" => [
                "Link" => "url",
            ],
            "icon" => "image",
            "label" => "Zdjęcia",
        ],
        "link" => [
            "type" => "url",
            "label" => "Link",
            "icon" => "link",
        ],
        "location" => [
            "type" => "text",
            "label" => "Miejsce",
            "icon" => "map-marker",
        ],
        "cost" => [
            "type" => "text",
            "label" => "Koszt",
            "icon" => "cash-multiple",
        ],
    ];

    use CanBeSorted;
    public const SORTS = [
        "rating" => [
            "label" => "Po ocenie",
            "compare-using" => "function",
            "discr" => "averageRating",
        ],
    ];

    public const FILTERS = [
        "categories" => [
            "compare-using" => "field",
            "discr" => "categories",
            "operator" => "any",
        ],
        "rating" => [
            "label" => "Ranking",
            "icon" => "star",
            "compare-using" => "function",
            "discr" => "averageRating",
            "mode" => "one",
            "operator" => ">=",
            "options" => [
                "4,5 i wyższa" => 4.5,
                "4,0 i wyższa" => 4,
                "3.5 i wyższa" => 3.5,
                "3,0 i wyższa" => 3,
                "2,0 i wyższa" => 2,
                "ocenione" => 1,
            ],
        ],
        "cost" => [
            "label" => "Cena",
            "icon" => self::FIELDS["cost"]["icon"],
            "compare-using" => "function",
            "discr" => "isFree",
            "mode" => "one",
            "options" => [
                "Płatny" => 0,
                "Bezpłatny" => 1,
            ],
        ],
        "keywords" => [
            "compare-using" => "field",
            "discr" => "keywords",
            "operator" => "any",
        ],
        "location" => [
            "compare-using" => "field",
            "discr" => "location",
            "operator" => "any",
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
    use HasIconedAttributes;

    protected function casts(): array
    {
        return [
            "categories" => "collection",
            "keywords" => "collection",
            "image_paths" => "collection",
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

    public function locationPretty(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->location ?? "brak informacji",
        );
    }

    public function costPretty(): Attribute
    {
        $show_suffix = is_numeric($this->cost);
        return Attribute::make(
            get: fn () => $this->cost . ($show_suffix ? " zł" : ""),
        );
    }

    public function isFree(): bool
    {
        return in_array(Str::lower($this->cost), [
            "bezpłatny",
            "bezpłatnie",
            "za darmo",
        ]);
    }
    #endregion

    #region relations
    use CanBeReviewed;
    #endregion
}
