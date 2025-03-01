<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Setting;
use App\Models\StandardPage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public function index()
    {
        return view("main");
    }

    public function standardPage(string $slug): View
    {
        $page = StandardPage::visible()->get()
            ->firstWhere(fn ($page) => $page->slug == $slug);
        if (!$page) abort(404);

        return view("standard-page", compact("page"));
    }

    #region list & search
    public function list(string $model_name, Request $rq): View
    {
        if (in_array($model_name, ["specialists", "films"])) return view("errors.under-construction");

        $default_sort = "-updated_at";
        $sort_direction = ($rq->get("sort", $default_sort)[0] == "-") ? "desc" : "asc";
        $sort_field = Str::after($rq->get("sort", $default_sort), "-");

        $model = "App\\Models\\" . Str::of($model_name)->studly()->singular();
        $data = $model::visible(false)
            ->where(fn ($q) => $q
                // search query
                ->where("name", "like", "%{$rq->q}%")
                ->orWhere("description", "like", "%{$rq->q}%")
                ->orWhere("categories", "like", "%{$rq->q}%")
                ->orWhere("keywords", "like", "%{$rq->q}%")
            )
            ->where(function ($q) use ($rq) {
                // filters
                foreach ($rq->except(["q", "sort"]) as $filter => $value) {
                    $q = (is_array($value))
                        ? $q->where(fn ($qq) => collect($value)->each(fn ($v) => $qq->orWhereJsonContains($filter, $v)))
                        : $q->where($filter, $value);
                }
                return $q;
            })
            ->orderBy($sort_field, $sort_direction)
            ->paginate(25);

        return view("pages.$model_name.list", compact(
            "data",
        ));
    }
    #endregion

    #region view models
    public function viewCourse(Course $course): View
    {
        return view("pages.courses.view", compact(
            "course",
        ));
    }
    #endregion
}
