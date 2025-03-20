<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewCriterion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function listReviews(string $model, int $id): View
    {
        $reviews = Review::where("reviewable_type", "like", "%$model")
            ->where("reviewable_id", $id)
            ->paginate(25);

        $entity_name = "App\\Models\\$model";
        $entity = $entity_name::find($id);

        return view('pages.reviews.list', compact(
            "reviews",
            "entity",
            "model",
        ));
    }

    public function addReview(string $model, int $id): View
    {
        $entity_name = "App\\Models\\" . Str::of($model)->studly()->singular();
        $entity = $entity_name::find($id);

        $criteria = ReviewCriterion::visible()
            ->where("used_in_".Str::plural($model), true)
            ->get();

        return view('pages.reviews.add', compact(
            "entity",
            "model",
            "criteria",
        ));
    }

    public function processReview(Request $rq): RedirectResponse
    {
        if (!$rq->has("confirmed")) return back()->with("error", "Potwierdzenie uczestnictwa jest wymagane");

        $review = Review::create($rq->except(["_token"]));

        $criteria = collect($rq->all())
            ->filter(fn ($v, $k) => Str::startsWith($k, "criterion_"))
            ->mapWithKeys(fn ($v, $k) => [Str::after($k, "criterion_") => ["answer" => $v]]);
        $review->criteria()->sync($criteria);

        return redirect()->route("front-view-$rq->model", ["course" => $rq->reviewable_type::find($rq->reviewable_id)])->with("success", "Ocena dodana, dziękujemy!");
    }
}
