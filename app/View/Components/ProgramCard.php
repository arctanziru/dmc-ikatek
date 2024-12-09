<?php
namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProgramCard extends Component
{
    public string $name;
    public string $image;
    public string $desc;
    public int $target;
    public int $totalDonation;
    public string $category;
    public int $id;
    public string $status;
    public string $createdAt;
    public bool $fullwidth;
    public string $location;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $image = "images/placeholder.webp",
        string $desc,
        int $target,
        int $totalDonation,
        string $category,
        int $id,
        string $createdAt,
        string $status,
        bool $fullwidth = false,
        string $location = "",
    ) {
        $this->name = $name;
        $this->image = $image;
        $this->desc = $desc;
        $this->target = $target;
        $this->totalDonation = $totalDonation;
        $this->category = $category;
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->fullwidth = $fullwidth;
        $this->status = $status;
        $this->location = $location;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.program-card');
    }
}
