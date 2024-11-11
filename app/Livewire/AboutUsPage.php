<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.landing')]
#[Title('About Us Works - DMC Ikatek-UH')]
class AboutUsPage extends Component
{
  public function render()
  {
    return view('livewire.about-us');
  }
}
