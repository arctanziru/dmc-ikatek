<?php

namespace App\Livewire\Dashboard\CoveredArea;

use App\Models\CoveredArea;
use Livewire\Component;

class CoveredAreaCreate extends Component
{
    public $city_id;
    public $province_id;
    public $provinces = [];
    public $cities = [];


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
    ];

    public function save()
    {
        $this->validate();

        CoveredArea::create([
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
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
