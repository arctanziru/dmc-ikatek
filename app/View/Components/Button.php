<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $class;
    public $disabled;
    public $variant;
    public $size;
    public $rounded;
    public $allignment;
    public $color;

    public function __construct(
        $type = 'button',
        $class = '',
        $disabled = false,
        $variant = 'primary',
        $size = 'medium',
        $rounded = 'md',
        $allignment = 'center',
        $color = 'primary',
    ) {
        $this->type = $type;
        $this->class = $class;
        $this->disabled = $disabled;
        $this->variant = $variant;
        $this->size = $size;
        $this->rounded = $rounded;
        $this->allignment = $allignment;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.button');
    }
}
