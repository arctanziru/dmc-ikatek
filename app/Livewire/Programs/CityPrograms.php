<?php

namespace App\Livewire\Programs;

use App\Models\DisasterProgram;
use App\Models\Disaster;
use App\Models\CoveredArea;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.landing')]
#[Title('Programs in City - DMC Ikatek-UH')]
class CityPrograms extends Component
{
    use WithPagination;

    public $programSearch = '';
    public $disasterSearch = '';
    public $programPerPage = 10;
    public $disasterPerPage = 10;
    public $status = '';
    public $coveredArea;
    public $cityId;
    public $activeTab = 'existing';

    protected $queryString = ['programSearch', 'disasterSearch', 'programPerPage', 'disasterPerPage', 'status'];

    public function mount($coveredAreaId)
    {
        // Fetch the CoveredArea by its ID
        $this->coveredArea = CoveredArea::with('city.province')->findOrFail($coveredAreaId);

        // Get the city_id from the CoveredArea
        $this->cityId = $this->coveredArea->city_id;

        $this->programPerPage = $this->programPerPage ?? 10;
        $this->disasterPerPage = $this->disasterPerPage ?? 10;
        $this->programSearch = $this->programSearch ?? '';
        $this->disasterSearch = $this->disasterSearch ?? '';
        $this->status = $this->status ?? '';
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['programSearch', 'disasterSearch', 'programPerPage', 'disasterPerPage', 'status'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        // Fetch programs related to the city, including only verified donations
        $programs = DisasterProgram::with(['category', 'disaster', 'city'])
            ->withSum([
                'donations as total_verified_donations' => function ($query) {
                    $query->where('status', 'verified');
                }
            ], 'amount')
            ->where('city_id', $this->cityId)
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->programSearch !== '', function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->programSearch . '%')
                        ->orWhere('description', 'like', '%' . $this->programSearch . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->programPerPage);

        // Fetch disasters related to the city
        $disasters = Disaster::with(['city', 'user'])
            ->where('city_id', $this->cityId)
            ->when($this->disasterSearch !== '', function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->disasterSearch . '%')
                        ->orWhere('description', 'like', '%' . $this->disasterSearch . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->disasterPerPage);

        return view('livewire.programs.city-programs', [
            'programs' => $programs,
            'disasters' => $disasters,
            'coveredArea' => $this->coveredArea,
        ]);
    }
}
