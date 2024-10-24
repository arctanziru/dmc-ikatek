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

    // Perform search when "Search" button is clicked
    public function performSearch()
    {
        $this->resetPage(); // Reset to the first page
    }

    // Reset filters (search and category)
    public function resetFilters()
    {
        $this->search = '';
        $this->category_id = null;
        $this->resetPage(); // Reset to the first page
    }

    public function render()
    {
        // Fetch news articles
        $request = new Request([
            'page' => $this->page,
            'per_page' => 5,
            'search' => $this->search,
            'category_id' => $this->category_id,
        ]);

        $controller = app(NewsController::class);
        $response = $controller->index($request);

        $data = $response->getData(true);
        $news = collect($data['data']['items']);
        $pagination = $data['data']['pagination'];

        // Fetch all categories
        $categories = NewsCategory::all();

        // Pass news and categories to the view
        return view('livewire.news-page', compact('news', 'pagination', 'categories'));
    }
}
