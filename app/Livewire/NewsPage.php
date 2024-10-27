<?php

namespace App\Livewire;

use App\Http\Controllers\NewsController;
use App\Models\NewsCategory; // Import the NewsCategory model
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.landing')]
#[Title('News - DMC Ikatek FT-UH')]

class NewsPage extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $category_id;

    protected $queryString = ['search', 'category_id', 'page'];

    public function performSearch()
    {
        $this->resetPage();
    }



    public function updateCategoryAndFetchNews()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->category_id = null;
        $this->resetPage();
    }

    public function render()
    {
        $request = new Request([
            'page' => $this->page,
            'per_page' => 20,
            'search' => $this->search,
            'category_id' => $this->category_id,
        ]);

        $controller = app(NewsController::class);
        $response = $controller->index($request);

        $data = $response->getData(true);
        $news = collect($data['data']['items']);
        $pagination = $data['data']['pagination'];

        $categories = app(NewsCategory::class)->all();

        return view('livewire.news-page', compact('news', 'pagination', 'categories'));
    }
}
