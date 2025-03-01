<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class Filters extends Component
{
    public $model;
    public $fields;
    public $sorts;
    public $filters;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $modelName,
    ) {
        $this->modelName = $modelName;
        $this->model = "App\\Models\\" . Str::of($modelName)->studly()->singular();
        $this->fields = $this->model::FIELDS;

        $this->sorts = $this->model::getSorts();
        $this->filters = $this->model::FILTERS;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.filters');
    }
}
