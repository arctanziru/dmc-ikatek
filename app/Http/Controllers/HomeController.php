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
            ->where('status', 'active') // Filter by active programs
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc') // Order by the most recent
            ->take(3) // Limit the results to 3
            ->get(); // Use get() instead of paginate()

        $totalProgramCount = DisasterProgram::count();
        $uniqueDonorCount = Donation::distinct('donor_email')->count('donor_email');
        $donationSum = Donation::sum('amount');
        $news = News::orderBy('created_at', 'desc')->take(5)->get();

        return view('index', compact('news', 'programs', 'totalProgramCount', 'uniqueDonorCount', 'donationSum'));
    }

}
