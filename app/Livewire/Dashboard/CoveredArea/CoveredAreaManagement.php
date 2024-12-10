<?php

namespace App\Livewire\Dashboard\CoveredArea;

use App\Models\CoveredArea;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Covered Area Management - DMC Ikatek-UH')]
#[Layout('components.layouts.dashboard')]
class CoveredAreaManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search', 'perPage'];

    public function mount()
    {
        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $coveredAreas = CoveredArea::with(relations: ['city', 'province'])
            ->whereHas('city', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('province', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.dashboard.covered-area.covered-area-management', ['coveredAreas' => $coveredAreas]);
    }

    public function redirectToCreate()
    {
        return redirect()->route('dashboard.covered-area.create');
    }

    public function redirectToEdit($coveredAreaId)
    {
        return redirect()->route('dashboard.covered-area.edit', ['coveredArea' => $coveredAreaId]);
    }

    public function delete($coveredAreaId)
    {
        $coveredArea = CoveredArea::findOrFail($coveredAreaId);
        $coveredArea->delete();

        session()->flash('title', 'Covered area deleted');
        session()->flash('message', 'The covered area has been deleted successfully');

        return redirect()->route('dashboard.covered-area');
    }
}
