<?php

namespace App\Livewire\Dashboard\Disaster\Program\Category;

use App\Models\DisasterProgramCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
#[Title('Disaster Program Category Management - DMC Ikatek-UH')]
class DisasterProgramCategoryManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search', 'perPage'];

    public function mount()
    {
        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = DisasterProgramCategory::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.dashboard.disaster.program.category.disaster-program-category-management', ['categories' => $categories]);
    }

    public function redirectToCreate()
    {
        return redirect()->route('dashboard.disaster.program.category.create');
    }

    public function redirectToEdit($categoryId)
    {
        return redirect()->route('dashboard.disaster.program.category.edit', ['category' => $categoryId]);
    }

    public function deleteCategory($categoryId)
    {
        $category = DisasterProgramCategory::find($categoryId);
        $category->delete();


        session()->flash('title', 'Category Deleted');
        session()->flash('message', 'Disaster Program Category "' . $category->name . '" deleted successfully.');

        return redirect()->route('dashboard.disaster.program.category');
    }
}
