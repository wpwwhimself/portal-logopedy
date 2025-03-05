<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Nav extends Component
{
    public $navLinks;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->navLinks = self::navLinks();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }

    #region helpers
    public static function navLinks(): array
    {
        return [
            ["Baza kursów, szkoleń...", route('front-list', ["model_name" => "courses"])],
            ["Baza uczelni", route('front-list', ["model_name" => "universities"])],
            ["Filmy, podcasty", route('front-list', ["model_name" => "films"])],
        ];
    }
    #endregion
}
