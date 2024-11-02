<?php

namespace App\Livewire\Dashboard\News;

use App\Models\News;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
#[Title('News Management')]
class NewsManagement extends Component
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
        $news = News::join('news_categories', 'news.news_category_id', '=', 'news_categories.id')
            ->select('news.*', 'news_categories.name as category')
            ->where('news.title', 'like', '%' . $this->search . '%')
            ->orWhere('news.content', 'like', '%' . $this->search . '%')
            ->orWhere('news_categories.name', 'like', '%' . $this->search . '%') // Include category name in search
            ->orderBy('news.created_at', 'desc')
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
