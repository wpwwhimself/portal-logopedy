<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function addReview(Request $rq): RedirectResponse
    {
        Review::create($rq->except(["_token"]));

        return back()->with("success", "Ocena dodana, dziękujemy!");
    }
}
