<?php

namespace App\View\Components;

use App\Models\Setting;
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
        return collect(json_decode(Setting::get("nav_labels"), true))
            ->map(fn ($label, $model) => [$label, route('front-list', ['model_name' => $model])])
            ->values()
            ->toArray();
    }
    #endregion
}
