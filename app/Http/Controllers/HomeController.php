<?php

namespace App\Http\Controllers;

use App\Models\CoveredArea;
use App\Models\Donation;
use App\Models\News; // Import the News model
use App\Models\DisasterProgram; // Import the News model
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $search = '';
    public $perPage = 10;
    public $status = '';
    public $totalCities;
    public $totalProvinces;
    public $provincesWithCities = [];

    public function mount()
    {

        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
        $this->status = $this->status ?? null;

        $coveredAreas = CoveredArea::with(relations: ['city', 'province'])
            ->orderBy('created_at', 'desc')
            ->get();


        $provincesWithCities = [];

        foreach ($coveredAreas as $area) {
            $provinceName = $area->province->name;
            $city = $area->city;

            if (!$city || !$provinceName) {
                continue;
            }

            if (!isset($provincesWithCities[$provinceName])) {
                $provincesWithCities[$provinceName] = [];
            }

            if (!in_array($city, $provincesWithCities[$provinceName])) {
                $provincesWithCities[$provinceName][] = $city;
            }
        }

        $this->provincesWithCities = $provincesWithCities;

        $this->totalCities = count(array_unique(
            array_merge(...array_values($provincesWithCities))
        ));
        $this->totalProvinces = count($provincesWithCities);
    }

   public function index()
{
    // Calculate totalCities and totalProvinces
    $coveredAreas = CoveredArea::with(['city', 'province'])
        ->orderBy('created_at', 'desc')
        ->get();

    $provincesWithCities = [];

    foreach ($coveredAreas as $area) {
        $provinceName = $area->province->name;
        $city = $area->city;

        if (!$city || !$provinceName) {
            continue;
        }

        if (!isset($provincesWithCities[$provinceName])) {
            $provincesWithCities[$provinceName] = [];
        }

        if (!in_array($city, $provincesWithCities[$provinceName])) {
            $provincesWithCities[$provinceName][] = $city;
        }
    }

    $totalCities = count(array_unique(array_merge(...array_values($provincesWithCities))));
    $totalProvinces = count($provincesWithCities);

    // Fetch other data
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

    return view('index', compact('news', 'programs', 'totalProgramCount', 'uniqueDonorCount', 'donationSum', 'totalCities', 'totalProvinces'));
}


}
