<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function list(): View
    {
        $articles = BlogArticle::visible()->paginate(10);

        return view("blog.list", compact(
            "articles",
        ));
    }

    public function view(string $slug): View
    {
        $article = BlogArticle::visible()->get()
            ->firstWhere(fn ($art) => $art->slug == $slug);

        return view("blog.view", compact(
            "article",
        ));
    }
}
