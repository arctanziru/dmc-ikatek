<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

use App\Models\AreaOfWork;


#[Layout('components.layouts.landing')]
#[Title('About Us Works - DMC Ikatek-UH')]
class AboutUsPage extends Component
{
  public function render()
  {
    // Fetch all areaOfWorks
    $areaOfWorks = AreaOfWork::all();  // Fetching all records without pagination

    // Pass the data to the view
    return view('livewire.about-us', [
      'areaOfWorks' => $areaOfWorks
    ]);
  }
}