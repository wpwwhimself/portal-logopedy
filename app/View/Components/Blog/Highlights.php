<?php

namespace App\View\Components\Blog;

use App\Models\BlogArticle;
use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Highlights extends Component
{
    public $meta;
    public $articles;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $title = null,
        public ?int $exceptId = null,
    ) {
        $this->title = $title ?? Setting::get("blog_name");

        $this->meta = BlogArticle::META;
        $this->articles = BlogArticle::recent($exceptId)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog.highlights');
    }
}
