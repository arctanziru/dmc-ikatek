<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.landing')]
#[Title('Our Reach - DMC Ikatek FT-UH')]
class HistoryPage extends Component
{
  public function render()
  {
    return view('livewire.history');
  }
}
