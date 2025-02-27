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

    #region search
    public function search(string $model_name, Request $rq)
    {
        $model = "App\\Models\\" . Str::of($model_name)->studly()->singular();
        $data = $model::visible()
            ->where("name", "like", "%{$rq->q}%")
            ->orWhere("description", "like", "%{$rq->q}%")
            ->orWhere("categories", "like", "%{$rq->q}%")
            ->orWhere("keywords", "like", "%{$rq->q}%")
            ->paginate(25);

        return view("pages.$model_name.list", compact(
            "data",
        ));
    }
    #endregion

    #region courses
    public function listCourses(): View
    {
        $data = Course::visible()
            ->with("industries")
            ->paginate(25);

        return view("pages.courses.list", compact(
            "data",
        ));
    }

    public function viewCourse(Course $course): View
    {
        return view("pages.courses.view", compact(
            "course",
        ));
    }
    #endregion

    #region specialists
    public function listSpecialists(): View
    {
        return view("errors.under-construction");
    //     $courses = Course::visible()
    //         ->with("industries")
    //         ->paginate(25);

    //     return view("pages.courses.list", compact(
    //         "courses",
    //     ));
    }

    // public function viewCourse(Course $course): View
    // {
    //     return view("pages.courses.view", compact(
    //         "course",
    //     ));
    // }
    #endregion

    #region films
    public function listFilms(): View
    {
        return view("errors.under-construction");
    //     $courses = Course::visible()
    //         ->with("industries")
    //         ->paginate(25);

    //     return view("pages.courses.list", compact(
    //         "courses",
    //     ));
    }

    // public function viewCourse(Course $course): View
    // {
    //     return view("pages.courses.view", compact(
    //         "course",
    //     ));
    // }
    #endregion
}
