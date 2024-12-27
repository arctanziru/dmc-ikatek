<?php

namespace App\Livewire\Dashboard\Disaster;

use App\Models\Disaster;
use App\Models\User;
use App\Notifications\NewDisasterNotification;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Create Disaster - DMC Ikatek-UH')]
class DisasterCreate extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $latitude;
    public $longitude;
    public $city_id;
    public $user_id;
    public $reporter_name;
    public $time_of_disaster;
    public $image;
    public $image_galleries = [];
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
        'time_of_disaster' => 'nullable|date',
        'image' => 'nullable|image|max:5120',
        'image_galleries.*' => 'nullable|image|max:5120',
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

        $image_path = $this->image ? $this->image->store('images', 'public') : null;
        $image_galleries_paths = [];
        if ($this->image_galleries) {
            foreach ($this->image_galleries as $image_gallery) {
                $image_galleries_paths[] = $image_gallery->store('image_galleries', 'public');
            }
        }

        $disaster = Disaster::create([
            'name' => $this->name,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'city_id' => $this->city_id,
            'user_id' => $this->user_id,
            'reporter_name' => $this->reporter_name,
            'status' => 'active',
            'time_of_disaster' => $this->time_of_disaster,
            'image' => $image_path,
            'image_galleries' => json_encode($image_galleries_paths),
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
