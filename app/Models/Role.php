<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use CanBeStringified;

    public $incrementing = false;
    protected $primaryKey = "name";
    protected $keyType = "string";
    public $timestamps = false;

    public const META = [
        "label" => "Role",
        "icon" => "key-chain",
    ];

    protected $fillable = [
        "name",
        "description",
    ];

    public const MANAGER_NOTIFICATIONS = [
        [
            "role" => "course-manager",
            "scope" => "courses",
            "message" => [
                "admins-with-role" => "course-master",
                "notification" => "CourseManagerMadeChangesNotification",
            ],
        ],
    ];

    #region relations
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    #endregion

    #region helpers
    public const ACCOUNT_TYPES = [
        "reviewer" => "Użytkownik",
        "course-manager" => "Organizator",
    ];
    #endregion
}
