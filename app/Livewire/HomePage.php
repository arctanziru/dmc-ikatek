<?php

namespace App\Livewire;

use App\Models\AreaOfWork;
use App\Models\DisasterProgram;
use App\Models\Donation;
use App\Models\News;
use App\Models\CoveredArea; // Import CoveredArea model
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.landing')]
#[Title('DMC Ikatek-UH')]
class HomePage extends Component
{
  public $search = ''; // To hold the search query
  public $totalCities;
  public $totalProvinces;
  public $provincesWithCities = [];

  public function render()
  {
    // Fetch programs and other data
    $programs = DisasterProgram::with(['category', 'disaster', 'donations'])
      ->withSum([
        'donations as total_verified_donations' => function ($query) {
          $query->where('status', 'verified'); // Only sum verified donations
        }
      ], 'amount')
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
    $donationSum = Donation::where('status', 'verified')->sum('amount');
    $news = News::orderBy('created_at', 'desc')->take(5)->get();
    $areaOfWorks = AreaOfWork::all();

    // Calculate totalCities and totalProvinces
    $this->calculateCitiesAndProvinces();

    return view('livewire.home-page', [
      'programs' => $programs,
      'totalProgramCount' => $totalProgramCount,
      'uniqueDonorCount' => $uniqueDonorCount,
      'donationSum' => $donationSum,
      'news' => $news,
      'areaOfWorks' => $areaOfWorks,
      'totalCities' => $this->totalCities,
      'totalProvinces' => $this->totalProvinces,
    ]);
  }

  // This method calculates the totalCities and totalProvinces
  public function calculateCitiesAndProvinces()
  {
    // Fetch CoveredArea data and related city and province
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

    // Set the public properties with calculated data
    $this->provincesWithCities = $provincesWithCities;
    $this->totalProvinces = count(array_unique(array_merge(...array_values($provincesWithCities))));
    $this->totalCities = count($provincesWithCities);
  }
}