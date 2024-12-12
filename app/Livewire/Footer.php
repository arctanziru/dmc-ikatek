<?php

namespace App\Livewire;

use App\Models\AreaOfWork;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $areaOfWorks = AreaOfWork::all();

        return view('livewire.footer', compact('areaOfWorks'));
    }
}
