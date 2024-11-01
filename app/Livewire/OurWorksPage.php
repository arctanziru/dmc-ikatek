<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.landing')]
#[Title('Our Works - DMC Ikatek FT-UH')]
class OurWorksPage extends Component
{


    public function render()
    {
        return view('livewire.our-works');
    }
}