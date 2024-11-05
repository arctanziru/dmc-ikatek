<?php

namespace App\Livewire\Dashboard\Disaster\Program;

use App\Models\Disaster;
use App\Models\DisasterProgram;
use App\Models\DisasterProgramCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Disaster Program - DMC Ikatek FT-UH')]
class DisasterProgramEdit extends Component
{
    use WithFileUploads;

    public $program;
    public $name;
    public $description;
    public $category_id;
    public $disaster_id;
    public $image;
    public $existingImage;
    public $tor_link;
    public $target_donation;

    public $categories = [];
    public $disasters = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'category_id' => 'required|exists:disaster_program_categories,id',
        'disaster_id' => 'required|exists:disasters,id',
        'image' => 'nullable|image|max:2048',
        'tor_link' => 'nullable|string|url',
        'target_donation' => 'nullable|numeric|min:0',
    ];

    public function mount(DisasterProgram $program)
    {
        $this->program = $program;
        $this->name = $program->name;
        $this->description = $program->description;
        $this->category_id = $program->category_id;
        $this->disaster_id = $program->disaster_id;
        $this->existingImage = $program->image;
        $this->tor_link = $program->tor_link;
        $this->target_donation = $program->target_donation;

        $this->categories = DisasterProgramCategory::all();
        $this->disasters = Disaster::all();
    }

    public function update()
    {
        $this->validate();

        $imagePath = $this->existingImage;
        if ($this->image) {
            if ($this->existingImage) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $this->existingImage));
            }
            $imagePath = '/storage/' . $this->image->store('images/disaster_programs', 'public');
        }

        $this->program->update([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'disaster_id' => $this->disaster_id,
            'image' => $imagePath,
            'tor_link' => $this->tor_link,
            'target_donation' => $this->target_donation,
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
