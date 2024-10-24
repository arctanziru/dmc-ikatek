<?php

namespace App\Http\Controllers;

use App\Models\News; // Import the News model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the latest news articles
        $news = News::orderBy('created_at', 'desc')->take(5)->get(); // Adjust the number of articles as needed

        return view('index', compact('news'));
    }
}
