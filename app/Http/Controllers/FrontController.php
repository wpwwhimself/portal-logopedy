<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

        return view("pages.courses.list", compact(
            "courses",
        ));
    }

    public function viewCourse(Course $course): View
    {
        return view("pages.courses.view", compact(
            "course",
        ));
    }
    #endregion
}
