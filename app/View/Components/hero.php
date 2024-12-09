<?php

namespace App\View\Components;

use App\Models\AreaOfWork; // Import the model (adjust the namespace to match your model)
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class hero extends Component
{
    public $areaOfWorks;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch all areaOfWorks from the database
        $this->areaOfWorks = AreaOfWork::all(); // Adjust query as needed, e.g., filtering or ordering
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero', [
            'areaOfWorks' => $this->areaOfWorks, // Pass the data to the view
        ]);
    }
}
