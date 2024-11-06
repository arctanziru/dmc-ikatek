<?php
namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProgramCard extends Component
{
    public string $name;
    public string $desc;
    public int $target;
    public int $totalDonation;
    public string $category;
    public int $id;
    public string $createdAt;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $desc,
        int $target,
        int $totalDonation,
        string $category,
        int $id,
        string $createdAt
    ) {
        $this->name = $name;
        $this->desc = $desc;
        $this->target = $target;
        $this->totalDonation = $totalDonation;
        $this->category = $category;
        $this->id = $id;
        $this->createdAt = $createdAt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.program-card');
    }
}
