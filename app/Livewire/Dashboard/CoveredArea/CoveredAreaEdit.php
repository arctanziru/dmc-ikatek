<?php

namespace App\Livewire\Dashboard\CoveredArea;

use Livewire\Component;

class CoveredAreaEdit extends Component
{
    public $coveredArea;
    public $city_id;
    public $province_id;
    public $provinces = [];
    public $cities = [];

    protected $rules = [
        'city_id' => 'required|exists:indonesia_cities,id',
        'province_id' => 'required|exists:indonesia_provinces,id',
    ];

    public function mount($coveredArea)
    {
        $this->coveredArea = $coveredArea;
        $this->city_id = $coveredArea->city_id;
        $this->province_id = $coveredArea->province_id;

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
        $this->validate([
            'city_id' => 'required|exists:indonesia_cities,id' . $this->city_id,
            'province_id' => 'required|exists:indonesia_provinces,id' . $this->province_id,
        ]);

        $this->coveredArea->update([
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
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
