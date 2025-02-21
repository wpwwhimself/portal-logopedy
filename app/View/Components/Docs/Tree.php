<?php

namespace App\View\Components\Docs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class Tree extends Component
{
    public $docs;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->docs = collect(glob(base_path("docs/**/*.md")))
            ->map(fn ($file) => Str::between($file, "docs/", ".md"))
            ->groupBy(fn ($file) => Str::before($file, "/"))
            ->map(fn ($group) => collect($group)
                ->mapWithKeys(fn ($file) => [Str::title(Str::after($file, "/")) => $file])
            );
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.docs.tree');
    }
}
