<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DisasterCard extends Component
{
    public $disaster;

    /**
     * Create a new component instance.
     */
    public function __construct($disaster)
    {
        $this->disaster = $disaster;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.disaster-card', ['item' => $this->disaster]);
    }
}
