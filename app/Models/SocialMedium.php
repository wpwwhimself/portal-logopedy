<?php

namespace App\Models;

use App\CanBeStringified;
use App\HasStandardScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SocialMedium extends Model
{
    use CanBeStringified;

    public const META = [
        "label" => "Social media",
        "icon" => "at",
        "description" => "Linki do mediów społecznościowych, jakimi reklamuje się aplikacja. Linki wraz z ikonami są wylistowane w stopce strony.",
    ];

    protected $fillable = [
        "name", "visible", "order",
        "link",
        "icon_path",
    ];

    public const FIELDS = [
        "link" => [
            "type" => "url",
            "label" => "Link",
            "icon" => "link",
            "required" => true,
        ],
        "icon_path" => [
            "type" => "storage_url",
            "label" => "Ikona",
            "icon" => "image",
        ],
    ];

    #region scopes
    use HasStandardScopes;
    #endregion

    #region attributes
    /**
     * checks if current user can see this page
     */
    public function canBeSeen(): bool
    {
        return $this->visible > 1 - Auth::check();
    }

    public function icon(): Attribute
    {
        return Attribute::make(
            get: function () {
                $path = asset($this->icon_path);
                return <<<BLADE
                <a href="$this->link" target="_blank">
                    <img src="$path" alt="$this->name" class="icon large">
                </a>
                BLADE;
            },
        );
    }
    #endregion
}
