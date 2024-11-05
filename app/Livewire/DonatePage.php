<?php

namespace App\Livewire;

use App\Http\Controllers\DisasterProgramController;
use App\Models\DisasterProgram;
use App\Models\News;
use App\Models\DisasterProgramCategory;
use Illuminate\Http\Request;


use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('components.layouts.landing')]
#[Title(content: 'Donate - DMC Ikatek FT-UH')]
class DonatePage extends Component
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

    public function performSearch()
    {
        $this->resetPage();
    }
    public function updateCategoryAndFetchProgram()
    {
        $this->resetPage();
    }

    public function render()
    {
        // $programs = DisasterProgram::where('title', 'like', '%' . $this->search . '%')
        //     ->orWhere('content', 'like', '%' . $this->search . '%')
        //     ->with('newsCategory')
        //     ->get();

        return view('livewire.donate');
    }
}
