<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CoverImage extends Component
{
    public string $src;
    public string $alt;

    /**
     * Create a new component instance.
     */
    public function __construct(string $src, string $alt = 'Cover Image')
    {
        $this->src = $src;
        $this->alt = $alt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cover-image');
    }
}
