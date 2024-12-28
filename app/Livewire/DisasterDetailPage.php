<?php

namespace App\Livewire;

use App\Models\Disaster;
use App\Models\DisasterProgram;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.landing')]
#[Title('Disaster - DMC Ikatek-UH')]
class DisasterDetailPage extends Component
{
    use WithPagination;

    public $disaster;
    public $search = '';
    public $perPage = 10;
    public $status = '';
    public $activeTab = 'existing';

    protected $queryString = ['search', 'perPage', 'status', 'activeTab'];

    public function mount($disasterid)
    {
        // Fetch the disaster based on the ID
        $this->disaster = Disaster::with(['city', 'user']) // Eager load related data
            ->findOrFail($disasterid); // Find disaster or fail with 404

        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
        $this->status = $this->status ?? '';
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'perPage', 'status', 'activeTab'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $programs = DisasterProgram::with(['category', 'city'])
            ->where('disaster_id', $this->disaster->id) // Filter programs for the disaster
            ->withSum([
                'donations as total_verified_donations' => function ($query) {
                    $query->where('status', 'verified');
                }
            ], 'amount')
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.disaster-detail-page', [
            'disaster' => $this->disaster,
            'programs' => $programs,
        ]);
    }
}
