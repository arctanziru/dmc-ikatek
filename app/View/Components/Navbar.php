<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navbar extends Component
{

    public $class;
    public $variant;
    /**
     * Create a new component instance.
     * 
     */
    public function __construct(
        $class = '',
        $variant = 'primary'
    ) {
        $this->class = $class;
        $this->variant = $variant;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}