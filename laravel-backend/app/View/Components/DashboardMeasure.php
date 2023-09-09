<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardMeasure extends Component
{
    private string $icon;
    private mixed $value;
    private string $unit;

    /**
     * Create a new component instance.
     */
    public function __construct(string $icon, mixed $value, string $unit = '')
    {
        $this->icon = $icon;
        $this->value = $value;
        $this->unit = $unit;

        if (is_integer($this->value)) {
            $this->value = number_format($this->value, 0, null, ' ');
        }

        if (is_float($this->value)) {
            $this->value = number_format($this->value, 1, ',');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.dashboard-measure', [
            'icon' => $this->icon,
            'unit' => $this->unit,
            'value' => $this->value,
        ]);
    }
}
