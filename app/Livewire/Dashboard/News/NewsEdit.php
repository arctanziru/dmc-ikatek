<?php

namespace App\Livewire\Dashboard\News;

use App\Livewire\Trix;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Edit News - DMC Ikatek-UH')]
class NewsEdit extends Component
{
    use WithFileUploads;

    public $news;
    public $title;
    public $image;
    public $news_category_id;
    public $description;
    public $content;
    public $author;

    public $categories = [];
    public $currentImage;

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

    public function mount(News $news)
    {
        $this->news = $news;
        $this->title = $news->title;
        $this->currentImage = $news->image;
        $this->news_category_id = $news->news_category_id;
        $this->description = $news->description;
        $this->content = $news->content;
        $this->author = $news->author;
        $this->categories = NewsCategory::all();
    }

    public function trix_value_updated($value)
    {
        $this->content = $value;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->currentImage;

        if ($this->image) {
            if ($this->currentImage) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $this->currentImage));
            }

            $imagePath = '/storage/' . $this->image->store('images/news', 'public');
        }

        $this->news->update([
            'title' => $this->title,
            'image' => $imagePath,
            'news_category_id' => $this->news_category_id,
            'description' => $this->description,
            'content' => $this->content,
            'author' => $this->author,
        ]);

        session()->flash('title', 'News Updated');
        session()->flash('message', 'News article "' . $this->title . '" updated successfully.');

        return redirect()->route('dashboard.news');
    }

    public function render()
    {
        return view('livewire.dashboard.news.news-edit');
    }
}
