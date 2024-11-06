<?php

namespace App\Http\Controllers;

use App\Models\News; // Import the News model
use App\Models\DisasterProgram; // Import the News model
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $search = '';
    public $perPage = 10;
    public $status = '';

    public function mount()
    {
        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
        $this->status = $this->status ?? null;
    }

    public function index()
    {

        $programs = DisasterProgram::with(['category', 'disaster', 'donations'])
            ->latest()
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })->orderBy('created_at', 'desc')->take(value: 5)
            ->paginate($this->perPage);

        // Fetch the latest news articles
        $news = News::orderBy('created_at', 'desc')->take(3)->get(); // Adjust the number of articles as needed

        return view('index', compact('news', 'programs'));
    }
}
