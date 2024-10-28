<?php

namespace App\Livewire\Dashboard\News;

use App\Models\News;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('News Management')]
class NewsManagement extends Component
{
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
        $news = News::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->with('newsCategory')
            ->paginate($this->perPage);

        return view('livewire.dashboard.news.news-management', ['news' => $news]);
    }

    public function redirectToCreate()
    {
        return redirect()->route('dashboard.news.create');
    }

    public function redirectToEdit($newsId)
    {
        return redirect()->route('dashboard.news.edit', ['news' => $newsId]);
    }

    public function deleteNews($newsId)
    {
        $news = News::find($newsId);
        $news->delete();
    }
}
