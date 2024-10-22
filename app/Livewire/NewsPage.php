<?php

namespace App\Livewire;

use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('components.layouts.landing')]
#[Title('Login - DMC Ikatek FT-UH')]

class NewsPage extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $category_id;

    protected $queryString = ['search', 'category_id', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function performSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
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

        return view('livewire.news-page', compact('news', 'pagination'));
    }
}
