<?php

namespace App\Livewire\Dashboard\News\Category;

use App\Models\NewsCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Edit News Category - DMC Ikatek-UH')]

class NewsCategoryEdit extends Component
{
    public $category;
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255|unique:news_categories,name',
        'description' => 'nullable|string',
    ];

    public function mount(NewsCategory $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:news_categories,name,' . $this->category->id,
            'description' => 'nullable|string',
        ]);

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'News Category updated successfully.');
        return redirect()->route('dashboard.news.category');
    }

    public function render()
    {
        return view('livewire.dashboard.news.category.news-category-edit');
    }
}
