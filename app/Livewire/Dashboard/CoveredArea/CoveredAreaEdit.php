<?php

namespace App\Livewire\Dashboard\CoveredArea;

use App\Models\CoveredArea;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Covererd Area - DMC Ikatek-UH')]
class CoveredAreaEdit extends Component
{
    use WithFileUploads;
    public $coveredArea;
    public $city_id;
    public $province_id;
    public $provinces = [];
    public $cities = [];
    public $description;
    public $image;
    public $image_galleries = [];
    public $existing_image_galleries = [];

    protected $rules = [
        'city_id' => 'required|exists:indonesia_cities,id',
        'province_id' => 'required|exists:indonesia_provinces,id',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:5120',
        'image_galleries.*' => 'nullable|image|max:5120',
    ];

    public function mount(CoveredArea $coveredArea)
    {
        $this->coveredArea = $coveredArea;
        $this->city_id = $coveredArea->city_id;
        $this->province_id = $coveredArea->province_id;
        $this->description = $coveredArea->description;
        $this->existing_image_galleries = json_decode($coveredArea->image_galleries, true) ?? [];

        $this->provinces = \Indonesia::allProvinces();

        $city = \Indonesia::findCity($this->city_id, ['province']);
        if ($city) {
            $this->province_id = $city->province->id;
            $province = \Indonesia::findProvince($this->province_id, ['cities']);
            if ($province) {
                $this->cities = $province->cities;
            } else {
                $this->cities = collect();
            }
        } else {
            $this->province_id = null;
            $this->cities = collect();
        }
    }

    public function updatedProvinceId($provinceId)
    {
        $this->cities = [];
        $this->cities = \Indonesia::findProvince($provinceId, ['cities'])['cities'];
    }

    public function update()
    {
        $this->validate();

        $image_path = $this->image ? $this->image->store('images', 'public') : $this->coveredArea->image;
        $uploadedImagePaths = [];
        foreach ($this->image_galleries as $image) {
            $uploadedImagePaths[] = $image->store('image_galleries', 'public');
        }
        $image_galleries_paths = array_merge($this->existing_image_galleries, $uploadedImagePaths);

        $this->coveredArea->update([
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
            'description' => $this->description,
            'image' => $image_path,
            'image_galleries' => json_encode($image_galleries_paths),
        ]);

        session()->flash('title', 'Covered area updated');
        session()->flash('message', 'The covered area has been updated successfully');

        return redirect()->route('dashboard.covered-area');
    }

    public function render()
    {
        return view('livewire.dashboard.covered-area.covered-area-edit');
    }
}
