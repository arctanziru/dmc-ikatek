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
        $programs = DisasterProgram::with(['category', 'disaster', 'donations'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
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
        session()->flash('message', 'Disaster Program "' . $program->name . '" deleted successfully.');
    }
}
