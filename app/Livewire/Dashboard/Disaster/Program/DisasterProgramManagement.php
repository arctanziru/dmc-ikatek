<?php

namespace App\Livewire\Dashboard\Disaster\Program;

use App\Models\DisasterProgram;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
#[Title('Disaster Program Management')]
class DisasterProgramManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $status = '';

    protected $queryString = ['search', 'perPage', 'status'];

    public function mount()
    {
        $this->perPage = $this->perPage ?? 10;
        $this->search = $this->search ?? '';
        $this->status = $this->status ?? null;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updateStatus($id, $status)
    {
        $program = DisasterProgram::find($id);
        if ($program) {
            $program->status = $status;
            $program->save();
        }
    }

    public function render()
    {
        $programs = DisasterProgram::with(['category', 'disaster', 'donations', 'city'])
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.dashboard.disaster.program.disaster-program-management', [
            'programs' => $programs,
        ]);
    }

    public function redirectToCreate()
    {
        return redirect()->route('dashboard.disaster.program.create');
    }

    public function redirectToEdit($programId)
    {
        return redirect()->route('dashboard.disaster.program.edit', ['program' => $programId]);
    }

    public function deleteProgram($programId)
    {
        $program = DisasterProgram::find($programId);
        if ($program) {
            $program->delete();
        }

        session()->flash('title', 'Program Deleted');
        session()->flash('message', 'Program "' . $program->name . '" deleted successfully.');

        return redirect()->route('dashboard.disaster.program');
    }
}
