<?php

namespace App\Models;

use App\CanBeReviewed;
use App\CanBeSorted;
use App\CanBeStringified;
use App\HasIconedAttributes;
use App\HasStandardScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;
use Wildside\Userstamps\Userstamps;

class Course extends Model
{
    use Userstamps, CanBeStringified;

    public const META = [
        "label" => "Kursy i szkolenia",
        "icon" => "book-open-page-variant",
        "description" => "Lista dostępnych kursów. Każda pozycja przechowuje informacje o kursie, jego terminy i oceny.",
    ];

    protected $fillable = [
        "name", "visible", "order",
        "categories",
        "description",
        "keywords",
        "thumbnail_path", "image_paths",
        "link",
        "trainer_name", "trainer_organization",
        "location",
        "dates",
        "cost",
        "final_document",
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
        "trainer_name" => [
            "type" => "text",
            "label" => "Nazwisko prowadzącego",
            "icon" => "badge-account",
        ],
        "trainer_organization" => [
            "type" => "text",
            "label" => "Organizator",
            "icon" => "badge-account",
        ],
        "location" => [
            "type" => "text",
            "label" => "Miejscowość",
            "icon" => "map-marker",
        ],
        "dates" => [
            "type" => "JSON",
            "column-types" => [
                "Data i godzina" => "datetime-local",
            ],
            "label" => "Terminy",
            "icon" => "calendar",
        ],
        "cost" => [
            "type" => "text",
            "label" => "Koszt",
            "icon" => "currency-usd",
        ],
        "final_document" => [
            "type" => "text",
            "label" => "Rodzaj dokumentu",
            "icon" => "certificate",
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
        "keywords" => [
            "compare-using" => "field",
            "discr" => "keywords",
            "operator" => "any",
        ],
        "location" => [
            "compare-using" => "field",
            "discr" => "location",
        ],
        "final_document" => [
            "compare-using" => "field",
            "discr" => "final_document",
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
            "dates" => "collection",
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
        return $this->iconedAttribute(
            $this->categories->first() . (($this->categories->count() > 1)
                ? " (+".($this->categories->count() - 1).")" . view("components.icon", ['name' => "chevron-down", "hint" => $this->categories->join("<br>")])->render()
                : ""
            ),
            "categories"
        ) ;
    }

    public function trainerPretty(): Attribute
    {
        return $this->iconedAttribute(
            implode(" | ", array_filter([$this->trainer_name, $this->trainer_organization])),
            "trainer_name",
            icon_hint: "Prowadzący"
        );
    }

    public function locationPretty(): Attribute
    {
        return $this->iconedAttribute(
            $this->location,
            "location"
        );
    }
    #endregion

    #region relations
    use CanBeReviewed;

    public function industries(): MorphToMany
    {
        return $this->morphToMany(Industry::class, "industriable");
    }
    #endregion
}
