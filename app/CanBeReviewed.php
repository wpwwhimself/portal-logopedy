<?php

namespace App;

use App\Models\Review;
use App\Models\ReviewCriterion;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Collection;

trait CanBeReviewed
{
    #region relations
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    #endregion

    #region attributes
    public function averageRating(): ?float
    {
        $reviews = $this->reviews
            ->map(fn ($r) => $r->criteria
                ->filter(fn($c) => is_numeric($c->pivot->answer))
                ->map(fn($c) => $c->pivot->answer)
                ->avg()
            );

        return $reviews->avg();
    }
    public function averageRatingPretty(): string
    {
        return number_format($this->averageRating(), 1, ",");
    }

    public function averageRatingByCriterion(ReviewCriterion $criterion): ?float
    {
        return $this->answersByCriterion($criterion)->avg();
    }
    public function averageRatingByCriterionPretty(ReviewCriterion $criterion): string
    {
        return implode(" ", [
            $this->averageRatingByCriterion($criterion)
                ? $criterion->options[round($this->averageRatingByCriterion($criterion))]
                : "bd.",
            view("components.reviews.stars", ["rating" => $this->averageRatingByCriterion($criterion)])->render(),
            "(". number_format($this->averageRatingByCriterion($criterion), 1, ",") .")"
        ]);
    }

    public function answerCountByCriterion(ReviewCriterion $criterion): int
    {
        return $this->answersByCriterion($criterion)->count();
    }
    #endregion

    #region helpers
    private function answersByCriterion(ReviewCriterion $criterion): Collection
    {
        return $reviews = $this->reviews
            ->map(fn ($r) => $r->criteria()
                ->wherePivot("review_criterion_id", $criterion->id)
                ->first()
                ?->pivot
                ->answer
            )
            ->filter();
    }
    #endregion
}
