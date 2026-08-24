<?php

namespace App\View\Components\Cbt;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CbtSteps extends Component
{
    /**
     * Create a new component instance.
     */

    public int $currentStep;

    public array $steps = [
        1 => 'Automatic Thoughts',
        2 => 'Cognitive Distortions',
        3 => 'Challenge the thought',
        4 => 'Reflection',
    ];


   public function __construct(int $currentStep = 1)
    {
        $this->currentStep = $currentStep;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cbt.cbt-steps');
    }
}
