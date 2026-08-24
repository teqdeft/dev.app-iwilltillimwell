<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LastStepPopup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $showAnchor;

    public function __construct($showAnchor)
    {
        $this->showAnchor = $showAnchor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $showAnchor = $this->showAnchor;
        return view('components.last-step-popup',compact('showAnchor'));
    }
}
