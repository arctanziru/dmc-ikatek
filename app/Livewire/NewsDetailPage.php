<?php

namespace App\Livewire;

use App\Models\News; // Import the News model
use App\Models\NewsCategory; // Import the NewsCategory model
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.landing')]
#[Title('News Detail - DMC Ikatek FT-UH')]
class NewsDetailPage extends Component
{
    public $news;
    public $recentNews;
    public $recentAuthorPosts;

    public function mount($id)
    {
        // Fetch the specific news article based on the ID from the URL parameter
        $this->news = News::findOrFail($id); // Eager load the category and author relationship

        // Fetch the 3 most recent news articles
        $this->recentNews = News::where('id', '!=', $id) // Exclude the current news article
            ->latest()
            ->take(3)
            ->get();

        // Fetch 3 most recent news articles from the same author
        $this->recentAuthorPosts = News::where('author', $this->news->author)
            ->where('id', '!=', $id) // Exclude the current news article
            ->latest()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.news-detail-page', [
            'news' => $this->news, // Pass the news data to the view
            'recentNews' => $this->recentNews, // Pass the recent news to the view
            'recentAuthorPosts' => $this->recentAuthorPosts, // Pass the recent posts by the same author to the view
        ]);
    }
}
