<?php

namespace App\Livewire\Dashboard\Disaster;

use App\Models\Disaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Disaster - DMC Ikatek-UH')]
class DisasterEdit extends Component
{
    use WithFileUploads;

    public $disaster;
    public $name;
    public $description;
    public $latitude;
    public $longitude;
    public $city_id;
    public $reporter_name;
    public $time_of_disaster;
    public $image;
    public $image_galleries = [];
    public $existing_image_galleries = [];
    public $selectedProvince = null;
    public $provinces = [];
    public $cities = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'city_id' => 'required|exists:indonesia_cities,id',
        'reporter_name' => 'nullable|string|max:255',
        'time_of_disaster' => 'nullable|date',
        'image' => 'nullable|image|max:5120',
        'image_galleries.*' => 'nullable|image|max:5120',

    ];

    public function mount(Disaster $disaster)
    {
        $this->disaster = $disaster;
        $this->name = $disaster->name;
        $this->description = $disaster->description;
        $this->latitude = $disaster->latitude;
        $this->longitude = $disaster->longitude;
        $this->city_id = $disaster->city_id;
        $this->reporter_name = $disaster->reporter_name;
        $this->existing_image_galleries = json_decode($disaster->image_galleries, true) ?? [];
        $this->time_of_disaster = $disaster->time_of_disaster;

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

    public function updatedSelectedProvince($provinceId)
    {
        $this->cities = [];
        $this->cities = \Indonesia::findProvince($provinceId, ['cities'])['cities'];
    }

    public function update()
    {
        $this->validate();

        $image_path = $this->image ? $this->image->store('images', 'public') : $this->disaster->image;
        $uploadedImagePaths = [];
        foreach ($this->image_galleries as $image) {
            $uploadedImagePaths[] = $image->store('image_galleries', 'public');
        }
        $image_galleries_paths = array_merge($this->existing_image_galleries, $uploadedImagePaths);

        $this->disaster->update([
            'name' => $this->name,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'city_id' => $this->city_id,
            'reporter_name' => $this->reporter_name,
            'time_of_disaster' => $this->time_of_disaster,
            'image' => $image_path,
            'image_galleries' => json_encode($image_galleries_paths),
        ]);

        session()->flash('title', 'Disaster Updated');
        session()->flash('message', 'Disaster updated successfully.');

        return redirect()->route('dashboard.disaster');
    }

    public function render()
    {
        return view('livewire.dashboard.disaster.disaster-edit');
    }
}
