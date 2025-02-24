<?php

namespace App\Models;

use App\CanBeStringified;
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
        "category", "subcategory",
        "description",
        "thumbnail_path",
        "link",
        "trainer_name", "trainer_organization",
        "location",
        "dates",
        "cost",
        "final_document",
    ];

    public const FIELDS = [
        "category" => [
            "type" => "text",
            "label" => "Kategoria",
            "icon" => "shape",
        ],
        "subcategory" => [
            "type" => "text",
            "label" => "Podkategoria",
            "icon" => "shape-outline",
        ],
        "description" => [
            "type" => "HTML",
            "label" => "Opis",
            "icon" => "pencil",
        ],
        "thumbnail_path" => [
            "type" => "url",
            "label" => "Miniatura",
            "icon" => "image",
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
        return $query->select($field)->distinct()->orderBy($field)->get()->pluck($field);
    }
    #endregion

    #region attributes
    protected function casts(): array
    {
        return [
            "dates" => "array",
        ];
    }

    public function canBeSeen(): bool
    {
        return $this->visible > 1 - Auth::check();
    }

    public function fullCategory(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(" | ", array_filter([$this->category, $this->subcategory])),
        );
    }

    public function trainer(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(" | ", array_filter([$this->trainer_name, $this->trainer_organization])),
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
