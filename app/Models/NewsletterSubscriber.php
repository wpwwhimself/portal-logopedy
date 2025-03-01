<?php

namespace App\Models;

use App\CanBeStringified;
use App\HasIconedAttributes;
use App\HasStandardScopes;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    use CanBeStringified;

    protected $stringify_key = "email";

    public const META = [
        "label" => "Newsletterowicze",
        "icon" => "email",
        "description" => "Lista adresów mailowych zapisanych do newslettera.",
    ];

    protected $fillable = [
        "email",
        "user_id",
    ];

    public const FIELDS = [
        "email" => [
            "type" => "email",
            "label" => "Email",
            "icon" => "email",
        ],
    ];

    public const CONNECTIONS = [
        "user" => [
            "model" => User::class,
            "mode" => "one",
        ],
    ];

    #region scopes
    use HasStandardScopes;
    #endregion

    #region attributes
    use HasIconedAttributes;
    #endregion

    #region relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    #endregion
}
