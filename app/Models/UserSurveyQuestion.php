<?php

namespace App\Models;

use App\CanBeStringified;
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
            "type" => "TEXT",
            "label" => "Opcje do wyboru",
            "icon" => "checkbox-marked",
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
    #endregion

    #region attributes
    protected function casts(): array
    {
        return [
            "options" => "json",
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
