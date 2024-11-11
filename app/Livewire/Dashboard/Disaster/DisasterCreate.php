<?php

namespace App\Livewire\Dashboard\Disaster;

use App\Models\Disaster;
use App\Models\User;
use App\Notifications\NewDisasterNotification;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Create Disaster - DMC Ikatek-UH')]
class DisasterCreate extends Component
{
    public $name;
    public $description;
    public $latitude;
    public $longitude;
    public $city_id;
    public $user_id;
    public $reporter_name;
    public $selectedProvince = null;
    public $provinces = [];
    public $cities = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'city_id' => 'required|exists:indonesia_cities,id',
        'user_id' => 'nullable|exists:users,id',
        'reporter_name' => 'nullable|string|max:255',
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

        $disaster = Disaster::create([
            'name' => $this->name,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'city_id' => $this->city_id,
            'user_id' => $this->user_id,
            'reporter_name' => $this->reporter_name,
            'status' => 'active',
        ]);

        $users = User::get();
        foreach ($users as $user) {
            $user->notify(new NewDisasterNotification($disaster));
        }

        session()->flash('title', 'Disaster Created');
        session()->flash('message', 'Disaster created successfully.');

        return redirect()->route('dashboard.disaster');
    }

    public function render()
    {
        return view('livewire.dashboard.disaster.disaster-create');
    }
}
