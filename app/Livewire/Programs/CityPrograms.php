<?php

namespace App\Livewire\Programs;

use App\Models\DisasterProgram;
use Laravolt\Indonesia\Models\City;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.landing')]
#[Title('Programs in City - DMC Ikatek-UH')]
class CityPrograms extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $status = '';
    public $city;
    public $activeTab = "existing";

    public function mount(City $city)
    {
        $this->city = $city;
        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
        $this->status = $this->status ?? '';
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'perPage', 'status'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $programs = DisasterProgram::query()
            ->with(['category', 'disaster', 'donations', 'city']) // Eager load necessary relations
            ->where('city_id', $this->city->id) // Filter by city ID directly
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status); // Filter by status if provided
            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc') // Order by creation date
            ->paginate($this->perPage);

        return view('livewire.programs.city-programs', [
            'programs' => $programs,
        ]);
    }
}
