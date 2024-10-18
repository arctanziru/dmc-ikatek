<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $class;
    public $disabled;
    public $variant;

    public function __construct(
        $type = 'button',
        $class = '',
        $disabled = false,
        $variant = 'primary'
    ) {
        $this->type = $type;
        $this->class = $class;
        $this->disabled = $disabled;
        $this->variant = $variant;
    }

    public function render()
    {
        return view('components.button');
    }
}
