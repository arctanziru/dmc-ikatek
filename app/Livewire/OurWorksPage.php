<?php

namespace App\Livewire;

use App\Models\DisasterProgramCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\AreaOfWork;

#[Layout('components.layouts.landing')]
#[Title('Our Works - DMC Ikatek-UH')]
class OurWorksPage extends Component
{
    public function render()
    {
        // Fetch all AreaOfWorks
        $areaOfWorks = AreaOfWork::all();

        // Manually fetch related DisasterProgramCategory for each AreaOfWork
        foreach ($areaOfWorks as $area) {
            // Fetch categories related to this specific areaOfWork
            $area->categories = DisasterProgramCategory::where('area_of_work_id', $area->id)->get();
        }

        // Pass the data to the view
        return view('livewire.our-works', [
            'areaOfWorks' => $areaOfWorks
        ]);
    }
}
