<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public bool $storageFile = false;
    public bool $extraButtons = false;
    public string $autofillRoute = "";

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $type = null,
        public string $name,
        public string $label,
        public ?string $hint = null,
        public mixed $value = null,
        public ?string $icon = null,
        public ?array $options = null,
        public ?bool $emptyOption = false,
        public ?array $columnTypes = null,
        public ?array $autofillFrom = null,
        public ?int $characterLimit = null,
    ) {
        $this->type = $type ?? "text";
        $this->name = $name;
        $this->label = $label;
        $this->hint = $hint;
        $this->value = $value;
        $this->icon = $icon;
        $this->options = $options;
        $this->emptyOption = $emptyOption;
        $this->columnTypes = $columnTypes;
        $this->characterLimit = $characterLimit;

        if ($this->type == "storage_url") {
            $this->type = "url";
            $this->storageFile = true;
        }

        if ($autofillFrom) {
            $this->autofillRoute = route($autofillFrom[0], ['model_name' => $autofillFrom[1]]);
        }

        $this->extraButtons = ($this->type == "url" && $this->value) || $this->storageFile;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
