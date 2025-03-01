<?php

namespace App\Models;

use App\CanBeStringified;
use App\HasStandardScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserSurveyQuestion extends Model
{
    use CanBeStringified;

    public const META = [
        "label" => "Pytania do użytkowników",
        "icon" => "microphone-message",
        "description" => "Pytania, na jakie użytkownik ma odpowiedzieć, aby doprecyzować jego potrzeby. Wykorzystywane w pokazywaniu użytkownikowi bardziej spersonalizowanych treści.",
    ];

    protected $fillable = [
        "name", "visible", "order",
        "description", "options",
    ];

    public const FIELDS = [
        "description" => [
            "type" => "TEXT",
            "label" => "Opis",
            "icon" => "help",
        ],
        "options" => [
            "type" => "JSON",
            "column-types" => [
                "Etykieta" => "text",
                "Wartość" => "text",
            ],
            "label" => "Opcje do wyboru",
            "icon" => "checkbox-marked",
            "hint" => "Jeśli pytanie ma skończoną liczbę odpowiedzi, wypisz je tutaj. W przeciwnym razie pozostaw to pole puste.",
        ],
    ];

    public const ACTIONS = [
        [
            "icon" => "eye",
            "label" => "Przeglądaj odpowiedzi",
            "route" => "profile-surveys",
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
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    #endregion
}
