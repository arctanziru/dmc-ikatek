<?php

namespace App\Livewire\Dashboard\Disaster\Program;

use App\Models\Disaster;
use App\Models\DisasterProgram;
use App\Models\DisasterProgramCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Create Disaster Program - DMC Ikatek-UH')]
class DisasterProgramCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $category_id;
    public $disaster_id;
    public $image;
    public $tor_link;
    public $target_donation;
    public $city_id;
    public $selectedProvince = null;
    public $provinces = [];
    public $cities = [];

    public $categories = [];
    public $disasters = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:disaster_program_categories,id',
        'disaster_id' => 'nullable|exists:disasters,id',
        'city_id' => 'nullable|exists:indonesia_cities,id',
        'image' => 'nullable|image|max:5120', //  Max 5MB
        'tor_link' => 'nullable|string|url',
        'target_donation' => 'nullable|numeric|min:0',
    ];

    public function updatedSelectedProvince($provinceId)
    {
        $this->cities = [];
        $this->cities = \Indonesia::findProvince($provinceId, ['cities'])['cities'];
        $this->city_id = null;
    }


    public function mount()
    {
        $this->provinces = \Indonesia::allProvinces();
        $this->categories = DisasterProgramCategory::all();
        $this->disasters = Disaster::all();
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? '/storage/' . $this->image->store('images/disaster_programs', 'public') : null;

        DisasterProgram::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'disaster_id' => $this->disaster_id,
            'city_id' => $this->city_id,
            'image' => $imagePath,
            'tor_link' => $this->tor_link,
            'target_donation' => $this->target_donation,
        ]);

        session()->flash('title', 'Program Created');
        session()->flash('message', 'Disaster Program "' . $this->name . '" created successfully.');

        return redirect()->route('dashboard.disaster.program');
    }


    public function render()
    {
        return view('livewire.dashboard.disaster.program.disaster-program-create');
    }
}
