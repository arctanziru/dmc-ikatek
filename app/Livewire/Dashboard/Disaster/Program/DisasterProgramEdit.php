<?php

namespace App\Livewire\Dashboard\Disaster\Program;

use App\Models\Disaster;
use App\Models\DisasterProgram;
use App\Models\DisasterProgramCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Disaster Program - DMC Ikatek FT-UH')]
class DisasterProgramEdit extends Component
{
    public $program;
    public $name;
    public $description;
    public $category_id;
    public $disaster_id;

    public $categories = [];
    public $disasters = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'category_id' => 'required|exists:disaster_program_categories,id',
        'disaster_id' => 'required|exists:disasters,id',
    ];

    public function mount(DisasterProgram $program)
    {
        $this->program = $program;
        $this->name = $program->name;
        $this->description = $program->description;
        $this->category_id = $program->category_id;
        $this->disaster_id = $program->disaster_id;

        $this->categories = DisasterProgramCategory::all();
        $this->disasters = Disaster::all();
    }

    public function update()
    {
        $this->validate();

        $this->program->update([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'disaster_id' => $this->disaster_id,
        ]);

        session()->flash('title', 'Program Updated');
        session()->flash('message', 'Disaster Program "' . $this->name . '" updated successfully.');

        return redirect()->route('dashboard.disaster.program');
    }

    public function render()
    {
        return view('livewire.dashboard.disaster.program.disaster-program-edit');
    }
}
