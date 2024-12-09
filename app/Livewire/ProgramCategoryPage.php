<?php
namespace App\Livewire;

use App\Models\DisasterProgram;
use App\Models\DisasterProgramCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.landing')]
#[Title('Program Category - DMC Ikatek-UH')]
class ProgramCategoryPage extends Component
{
    use WithPagination;

    public $categoryId;
    public $search = ''; // Search query
    public $perPage = 10; // Default items per page

    protected $queryString = ['search', 'perPage']; // Bind query string with pagination params

    public $activeTab = 'active'; // Default active tab

    public function mount($id)
    {
        $this->categoryId = $id; // Capture the category ID from the route
        $this->perPage = $this->perPage ?? 10; // Default perPage value
        $this->search = $this->search ?? ''; // Default search value
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'perPage'])) {
            $this->resetPage(); // Reset pagination when search or perPage is updated
        }
    }

    // Manually trigger search when the user hits Enter
    public function performSearch()
    {
        $this->resetPage(); // Reset pagination when search is performed
    }

    public function render()
    {
        $programCategory = DisasterProgramCategory::findOrFail($this->categoryId);
        $programCategory->image_galleries = json_decode($programCategory->image_galleries, true);

        // Fetch all programs and paginate them
        $programs = DisasterProgram::where('category_id', $this->categoryId)
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.program-category', [
            'programCategory' => $programCategory,
            'programs' => $programs,
        ]);
    }
}
