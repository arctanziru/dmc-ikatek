<?php

namespace App\Livewire\Dashboard\News\Category;

use App\Models\NewsCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Create News - DMC Ikatek-UH')]

class NewsCategoryCreate extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255|unique:news_categories,name',
        'description' => 'nullable|string|max:500',
    ];

    public function save()
    {
        $this->validate();

        NewsCategory::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'News Category created successfully.');
        return redirect()->route('dashboard.news.category');
    }

    public function render()
    {
        return view('livewire.dashboard.news.category.news-category-create');
    }
}
