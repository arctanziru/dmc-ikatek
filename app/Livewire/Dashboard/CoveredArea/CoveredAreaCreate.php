<?php

namespace App\Livewire\Dashboard\CoveredArea;

use App\Models\CoveredArea;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Add Covered Area - DMC Ikatek-UH')]
class CoveredAreaCreate extends Component
{
    use WithFileUploads;
    public $city_id;
    public $province_id;
    public $provinces = [];
    public $cities = [];

    public $description;
    public $image;
    public $image_galleries = [];


    public function mount()
    {
        $this->provinces = \Indonesia::allProvinces();
    }

    public function updatedProvinceId($provinceId)
    {
        $this->cities = [];
        $this->cities = \Indonesia::findProvince($provinceId, ['cities'])['cities'];
        $this->city_id = null;
    }

    protected $rules = [
        'city_id' => 'required|exists:indonesia_cities,id',
        'province_id' => 'required|exists:indonesia_provinces,id',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:5120',
        'image_galleries.*' => 'nullable|image|max:5120',
    ];

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

        CoveredArea::create([
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
            'description' => $this->description,
            'image' => $image_path,
            'image_galleries' => json_encode($image_galleries_paths),
        ]);

        session()->flash('title', 'Covered area created');
        session()->flash('message', 'The covered area has been created successfully');

        return redirect()->route('dashboard.covered-area');
    }

    public function render()
    {
        return view('livewire.dashboard.covered-area.covered-area-create');
    }
}
