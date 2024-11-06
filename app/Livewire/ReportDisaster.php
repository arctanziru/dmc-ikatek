<?php

namespace App\Livewire;

use App\Models\Disaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.landing')]
#[Title('Create Disaster - DMC Ikatek FT-UH')]
class ReportDisaster extends Component
{
    public $name;
    public $description;
    public $latitude;
    public $longitude;
    public $city_id;
    public $user_id;
    public $selectedProvince = null;
    public $provinces = [];
    public $cities = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'city_id' => 'required|exists:indonesia_cities,id',
        'user_id' => 'required|exists:users,id',
    ];

    public function mount()
    {
        $this->provinces = \Indonesia::allProvinces();
        $this->user_id = auth()->user()->id;
    }
    public function updatedSelectedProvince($provinceId)
    {
        $this->cities = [];
        $this->cities = \Indonesia::findProvince($provinceId, ['cities'])['cities'];
        $this->city_id = null;
    }


    public function save()
    {
        $this->validate();

        Disaster::create([
            'name' => $this->name,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'city_id' => $this->city_id,
            'user_id' => $this->user_id,
        ]);

        session()->flash('title', 'Disaster Created');
        session()->flash('message', 'Disaster created successfully.');

        return redirect()->route('dashboard.disaster');
    }

    public function render()
    {
        return view('livewire.report-disaster');
    }
}
