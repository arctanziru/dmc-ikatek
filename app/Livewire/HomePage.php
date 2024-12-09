<?php

namespace App\Livewire;

use App\Models\AreaOfWork;
use App\Models\DisasterProgram;
use App\Models\Donation;
use App\Models\News;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.landing')]
#[Title('DMC Ikatek-UH')]
class HomePage extends Component
{
    public $search = ''; // To hold the search query

    public function render()
    {
        $programs = DisasterProgram::with(['category', 'disaster', 'donations'])
            ->where('status', 'active')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->take(3) // Limit to 3 programs
            ->get();

        $totalProgramCount = DisasterProgram::count();

        $uniqueDonorCount = Donation::distinct('donor_email')->count('donor_email');

        $donationSum = Donation::sum('amount');

        $news = News::orderBy('created_at', 'desc')->take(5)->get();

        $areaOfWorks = AreaOfWork::all();

        return view('livewire.home-page', [
            'programs' => $programs,
            'totalProgramCount' => $totalProgramCount,
            'uniqueDonorCount' => $uniqueDonorCount,
            'donationSum' => $donationSum,
            'news' => $news,
            'areaOfWorks' => $areaOfWorks,
        ]);
    }
}
