<?php

namespace App\Livewire\Programs;

use App\Models\DisasterProgram;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.landing')]
#[Title('Programs - DMC Ikatek-UH')]
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
        $programs = DisasterProgram::with(['category', 'disaster', 'donations'])
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.program.program-page', ['programs' => $programs]);
    }
}
