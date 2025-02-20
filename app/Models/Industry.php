<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;
use Wildside\Userstamps\Userstamps;

class Industry extends Model
{
    use Userstamps, CanBeStringified;

    public const META = [
        "label" => "Branże",
        "icon" => "robot-industrial",
        "description" => "Ogólnopojęte branże logopedii. Mogą być przypisane do użytkowników, aby pozwolić im doprecyzować ich zainteresowania, albo do kursów bądź innych bytów, aby ułatwić ich filtrowanie.",
    ];

    protected $fillable = [
        "name",
        "description",
    ];

    public const FIELDS = [
        "description" => [
            "type" => "TEXT",
            "label" => "Opis",
            "icon" => "pencil",
        ],
    ];

    #region scopes
    public function scopeForAdminList($query)
    {
        return $query->orderBy("name");
    }
    #endregion

    #region attributes
    /**
     * checks if current user can see this page
     */
    public function canBeSeen(): bool
    {
        return $this->visible > 1 - Auth::check();
    }
    #endregion

    #region relations
    public function courses(): MorphToMany
    {
        return $this->morphedByMany(Course::class, "industriable");
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, "industriable");
    }
    #endregion
}
