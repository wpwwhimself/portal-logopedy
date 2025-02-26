<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Setting;
use App\Models\StandardPage;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

        return view("standard-page", compact("page"));
    }

    #region courses
    public function listCourses(): View
    {
        $courses = Course::visible()
            ->with("industries")
            ->paginate(25);

        $bulletpoints = collect(json_decode(Setting::get("course_bulletpoints")))
            ->sortBy(fn ($bp) => (int) $bp[0]);

        return view("pages.courses.list", compact(
            "courses",
            "bulletpoints",
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
