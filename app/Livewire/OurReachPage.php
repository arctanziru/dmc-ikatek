<?php

namespace App\Livewire;

use App\Models\CoveredArea;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.landing')]
#[Title('Our Reach - DMC Ikatek-UH')]
class OurReachPage extends Component
{
  public $coveredAreas;
  public $totalCities;
  public $totalProvinces;
  public $provincesWithCities = [];


  public function mount()
  {
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

      // Add CoveredArea ID and City ID for display and actions
      if (!in_array($city->id, array_column($provincesWithCities[$provinceName], 'city_id'))) {
        $provincesWithCities[$provinceName][] = [
          'covered_area_id' => $area->id, // CoveredArea ID
          'city_id' => $city->id,         // City ID
          'name' => $city->name,
        ];
      }
    }

    $this->provincesWithCities = $provincesWithCities;

    $uniqueCities = [];
    foreach ($provincesWithCities as $cities) {
      foreach ($cities as $city) {
        $uniqueCities[$city['city_id']] = true; // Ensure uniqueness using City ID
      }
    }

    $this->totalCities = count($uniqueCities);
    $this->totalProvinces = count($provincesWithCities);
  }


  public function render()
  {
    return view('livewire.our-reach');
  }

  public function redirectToPrograms($coveredAreaId)
  {
    return redirect()->route('city-programs', ['coveredAreaId' => $coveredAreaId]);
  }
}
