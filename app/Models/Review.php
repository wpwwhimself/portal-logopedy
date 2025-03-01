<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Review extends Model
{
    use CanBeStringified, Userstamps;

    public const META = [
        "label" => "Oceny",
        "icon" => "message-star",
    ];

    const UPDATED_BY = null;

    protected $fillable = [
        "title",
        "description",
        "rating",
        "reviewable_id", "reviewable_type",
    ];

    #region relations
    public function reviewable()
    {
        return $this->morphTo();
    }

    public function criteria()
    {
        return $this->belongsToMany(ReviewCriterion::class)
            ->withPivot("answer")
            ->orderBy("order");
    }
    #endregion

    #region attributes
    public function averageRating(): ?float
    {
        return $this->criteria
            ->filter(fn($c) => is_numeric($c->pivot->answer))
            ->map(fn($c) => $c->pivot->answer)
            ->avg();
    }
    #endregion

    #region helpers
    public const RATINGS = [
        1,
        2,
        3,
        4,
        5,
    ];
    #endregion
}
