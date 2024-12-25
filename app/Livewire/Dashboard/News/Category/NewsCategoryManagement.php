<?php

namespace App\Livewire\Dashboard\News\Category;

use App\Models\NewsCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
#[Title('News Management - DMC Ikatek-UH')]

class NewsCategoryManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search', 'perPage'];

    public function mount()
    {
        $this->search = $this->search ?? '';
        $this->perPage = $this->perPage ?? 10;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function redirectToCreate()
    {
        return redirect()->route('dashboard.news.category.create');
    }

    public function redirectToEdit($categoryId)
    {
        return redirect()->route('dashboard.news.category.edit', ['category' => $categoryId]);
    }

    public function deleteCategory($categoryId)
    {
        $category = NewsCategory::find($categoryId);

        if ($category) {
            $category->delete();
            session()->flash('title', 'News Category Deleted');
            session()->flash('message', 'News Category "' . $category->name . '" deleted successfully.');
            return redirect()->route('dashboard.news.category');
        }
    }

    public function render()
    {
        $categories = NewsCategory::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.dashboard.news.category.news-category-management', [
            'categories' => $categories,
        ]);
    }
}
