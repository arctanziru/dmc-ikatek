<?php

namespace App\Livewire\Dashboard\News;

use App\Livewire\Trix;
use App\Models\News;
use App\Models\NewsCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Create News - DMC Ikatek-UH')]

class NewsCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $image;
    public $news_category_id;
    public $description;
    public $content;
    public $author;

    public $categories = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'news_category_id' => 'required|exists:news_categories,id',
        'description' => 'required|string|max:500',
        'content' => 'required|string',
        'author' => 'required|string|max:255',
    ];

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED
    ];

    public function trix_value_updated($value)
    {
        $this->content = $value;
    }

    public function mount()
    {
        $this->categories = NewsCategory::all();
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? '/storage/' . $this->image->store('images/news', 'public') : null;


        News::create([
            'title' => $this->title,
            'image' => $imagePath,
            'news_category_id' => $this->news_category_id,
            'description' => $this->description,
            'content' => $this->content,
            'author' => $this->author,
        ]);

        session()->flash('title', 'News Created');
        session()->flash('message', 'News article' . $this->title . 'created successfully.');

        return redirect()->route('dashboard.news');
    }

    public function render()
    {
        return view('livewire.dashboard.news.news-create');
    }
}
