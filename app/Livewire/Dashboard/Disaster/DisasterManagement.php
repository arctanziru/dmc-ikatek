<?php

namespace App\Livewire\Dashboard\Disaster;

use App\Models\Disaster;
use Laravolt\Indonesia\Models\District;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
#[Title('Disaster Management')]
class DisasterManagement extends Component
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
        $disasters = Disaster::join('indonesia_cities', 'disasters.city_id', '=', 'indonesia_cities.id')
            ->join('users', 'disasters.user_id', '=', 'users.id')
            ->select('disasters.*', 'indonesia_cities.name as city_name', 'users.name as user_name')
            ->where('disasters.name', 'like', '%' . $this->search . '%')
            ->orWhere('disasters.description', 'like', '%' . $this->search . '%')
            ->orWhere('indonesia_cities.name', 'like', '%' . $this->search . '%')
            ->orderBy('disasters.created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.dashboard.disaster.disaster-management', ['disasters' => $disasters]);
    }

    public function redirectToCreate()
    {
        return redirect()->route('dashboard.disaster.create');
    }

    public function redirectToEdit($disasterId)
    {
        return redirect()->route('dashboard.disaster.edit', ['disaster' => $disasterId]);
    }

    public function updateStatus($id, $status)
    {
        $disaster = Disaster::find($id);
        if ($disaster) {
            $disaster->status = $status;
            $disaster->save();
        }
    }

    public function deleteDisaster($disasterId)
    {
        $disaster = Disaster::find($disasterId);
        $disaster->delete();
    }
}
