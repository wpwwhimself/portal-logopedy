<?php

namespace App;

use App\Models\Review;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait CanBeReviewed
{
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function averageRating(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->reviews()->avg("rating"), 2, ","),
        );
    }
}
