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
#[Title('Edit Disaster Program - DMC Ikatek-UH')]
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
    public $city_id;

    public $categories = [];
    public $disasters = [];
    public $selectedProvince = null;
    public $provinces = [];
    public $cities = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:disaster_program_categories,id',
        'disaster_id' => 'required|exists:disasters,id',
        'city_id' => 'nullable|exists:indonesia_cities,id',
        'image' => 'nullable|image|max:5120',
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

        $this->provinces = \Indonesia::allProvinces();

        $city = \Indonesia::findCity($this->city_id, ['province']);
        if ($city) {
            $this->selectedProvince = $city->province->id;
            $province = \Indonesia::findProvince($this->selectedProvince, ['cities']);
            if ($province) {
                $this->cities = $province->cities;
            } else {
                $this->cities = collect(); // Initialize as an empty collection
            }
        } else {
            $this->selectedProvince = null;
            $this->cities = collect(); // Initialize as an empty collection
        }
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
            'city_id' => $this->city_id,
        ]);

        session()->flash('title', 'Program Updated');
        session()->flash('message', 'Program "' . $this->name . '" updated successfully.');

        return redirect()->route('dashboard.disaster.program');
    }

    public function render()
    {
        return view('livewire.dashboard.disaster.program.disaster-program-edit');
    }
}
