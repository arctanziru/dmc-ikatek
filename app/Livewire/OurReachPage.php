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

  public function render()
  {
    return view('livewire.our-reach');
  }

  public function redirectToPrograms($cityId)
  {
    return redirect()->route('city-programs', ['city' => $cityId]);
  }
}
