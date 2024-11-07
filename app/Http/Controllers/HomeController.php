<?php

namespace App\Http\Controllers;

use App\Models\Donation;
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
            ->where('status', 'active') // Only get active programs
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->take(3) // Limit to the first 3 programs
            ->paginate($this->perPage);


        $totalProgramCount = DisasterProgram::count();

        // Get the unique count of donations by donor_email
        $uniqueDonorCount = Donation::distinct('donor_email')->count('donor_email');

        // Get the sum of the 'amount' field in donations
        $donationSum = Donation::sum('amount');
        // Fetch the latest news articles
        $news = News::orderBy('created_at', 'desc')->take(5)->get(); // Adjust the number of articles as needed

        return view('index', compact('news', 'programs', 'totalProgramCount', 'uniqueDonorCount', 'donationSum'));
    }
}
