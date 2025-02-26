<?php

namespace App\Models;

use App\CanBeReviewed;
use App\CanBeStringified;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;
use Wildside\Userstamps\Userstamps;

class Course extends Model
{
    use Userstamps, CanBeStringified, CanBeReviewed;

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
            "label" => "Kategoria",
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
            "placeholder" => "online",
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

    public const CONNECTIONS = [
        // "industries" => [
        //     "model" => Industry::class,
        //     "mode" => "many",
        // ],
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

    public function scopeClasses($query, string $field)
    {
        return $query->select($field)->get()
            ->pluck($field)
            ->flatten()
            ->sort()
            ->unique();
    }
    #endregion

    #region attributes
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
        return Attribute::make(
            get: fn () => view("components.icon", [
                "name" => self::FIELDS["categories"]["icon"],
                "hint" => self::FIELDS["categories"]["label"],
            ])->render() . $this->categories->first() . (($this->categories->count() > 1) ? " (+".($this->categories->count() - 1).")" : ""),
        );
    }

    public function trainerPretty(): Attribute
    {
        return Attribute::make(
            get: fn () => view("components.icon", [
                "name" => self::FIELDS["trainer_name"]["icon"],
                "hint" => "Prowadzący",
            ])->render() . implode(" | ", array_filter([$this->trainer_name, $this->trainer_organization])),
        );
    }

    public function location(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->location ?? "online",
        );
    }
    public function locationPretty(): Attribute
    {
        return Attribute::make(
            get: fn () => view("components.icon", [
                "name" => self::FIELDS["location"]["icon"],
                "hint" => self::FIELDS["location"]["label"],
            ])->render() . $this->location,
        );
    }
    #endregion

    #region relations
    public function industries(): MorphToMany
    {
        return $this->morphToMany(Industry::class, "industriable");
    }
    #endregion
}
