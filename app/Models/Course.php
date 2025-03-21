<?php

namespace App\Models;

use App\CanBeReviewed;
use App\CanBeSorted;
use App\CanBeStringified;
use App\HasIconedAttributes;
use App\HasStandardScopes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Wildside\Userstamps\Userstamps;

class Course extends Model
{
    use Userstamps, CanBeStringified, SoftDeletes;

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
        "locations",
        "dates",
        "cost",
        // "final_document",
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
            "autofill-from" => ["entmgr-list-categories", "courses"],
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
            "hide-for-entmgr" => true,
        ],
        "thumbnail_path" => [
            "type" => "url",
            "label" => "Miniatura",
            "icon" => "image",
            "hide-for-entmgr" => true,
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
            "label" => "Osoba prowadząca",
            "icon" => "badge-account",
        ],
        "trainer_organization" => [
            "type" => "text",
            "label" => "Organizator",
            "icon" => "badge-account",
        ],
        "locations" => [
            "type" => "JSON",
            "column-types" => [
                "Miejsce" => "text",
            ],
            "label" => "Miejsca",
            "icon" => "map-marker",
            "hide-for-entmgr" => true,
        ],
        "dates" => [
            "type" => "JSON",
            "column-types" => [
                "Data i godzina" => "datetime-local",
            ],
            "label" => "Terminy",
            "icon" => "calendar",
            "hide-for-entmgr" => true,
        ],
        "cost" => [
            "type" => "text",
            "label" => "Koszt",
            "icon" => "cash-multiple",
            "hide-for-entmgr" => true,
        ],
        // "final_document" => [
        //     "type" => "text",
        //     "label" => "Rodzaj dokumentu",
        //     "icon" => "certificate",
        // ],
    ];

    public const ACTIONS = [
        [
            "icon" => University::META["icon"],
            "label" => "Przekształć na Uczelnię",
            "show-on" => "edit",
            "route" => "morph-course-to-university",
            "dangerous" => true,
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
        "locations" => [
            "compare-using" => "field",
            "discr" => "locations",
            "operator" => "any",
        ],
        // "final_document" => [
        //     "compare-using" => "field",
        //     "discr" => "final_document",
        // ],
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
            "locations" => "collection",
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
        return Attribute::make(
            get: fn () => $this->categories?->first() . (($this->categories?->count() > 1)
                ? " (+".($this->categories->count() - 1).")" . view("components.icon", ['name' => "chevron-down", "hint" => $this->categories->join("<br>")])->render()
                : ""
            ),
        );
    }

    public function trainerPretty(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(" | ", array_filter([$this->trainer_name, $this->trainer_organization])),
        );
    }

    public function locationsPretty(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->locations?->first() . (($this->locations?->count() > 1)
                ? " (+".($this->locations->count() - 1).")" . view("components.icon", ['name' => "chevron-down", "hint" => $this->locations->join("<br>")])->render()
                : ""
            ),
        );
    }

    public function datesProcessed(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->dates?->map(fn ($d) => Str::of($d)->test('/^\d{4}-\d{2}-\d{2}/') ? Carbon::parse($d)->format("d.m.Y H:i") : $d),
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

    public function industries(): MorphToMany
    {
        return $this->morphToMany(Industry::class, "industriable");
    }
    #endregion
}
