<?php

namespace App\Models;

use App\CanBeStringified;
use App\HasStandardScopes;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class ReviewCriterion extends Model
{
    use CanBeStringified, Userstamps;

    public const META = [
        "label" => "Kryteria oceny",
        "icon" => "star-cog",
        "description" => "Pytania, na jakie użytkownik odpowiada, dając ocenę.",
    ];

    protected $fillable = [
        "name", "visible", "order",
        "description", "options",
        "used_in_courses",
    ];

    public const FIELDS = [
        "description" => [
            "type" => "TEXT",
            "label" => "Opis",
            "icon" => "help",
            "hint" => "Wyświetla się jako podpowiedź do pytania",
        ],
        "options" => [
            "type" => "JSON",
            "column-types" => [
                "Wartość" => "number",
                "Etykieta" => "text",
            ],
            "label" => "Opcje do wyboru",
            "icon" => "checkbox-marked",
            "hint" => "Jeśli pytanie ma skończoną liczbę odpowiedzi, wypisz je tutaj. W przeciwnym razie pozostaw to pole puste.",
        ],
        "used_in_courses" => [
            "type" => "checkbox",
            "label" => "Występuje dla kursów",
            "icon" => Course::META['icon'],
        ],
    ];

    #region scopes
    use HasStandardScopes;
    #endregion

    #region attributes
    protected function casts(): array
    {
        return [
            "options" => "array",
        ];
    }
    #endregion

    #region relations
    public function reviews()
    {
        return $this->belongsToMany(Review::class);
    }
    #endregion
}
