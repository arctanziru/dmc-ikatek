<?php

namespace App\Livewire;

use App\Models\DisasterProgram;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;



#[Layout('components.layouts.landing')]
#[Title(content: 'Donate - DMC Ikatek FT-UH')]
class ProgramPage extends Component
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
        $programs = DisasterProgram::with(['category', 'disaster', 'donations'])
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.program-page',['programs'=> $programs]);
    }
}
