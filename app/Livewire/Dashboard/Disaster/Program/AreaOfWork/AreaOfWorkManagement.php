<?php

namespace App\Livewire\Dashboard\Disaster\Program\AreaOfWork;

use App\Models\AreaOfWork;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Area Of Work Management - DMC Ikatek-UH')]
class AreaOfWorkManagement extends Component
{
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
    $areaOfWorks = AreaOfWork::query()
      ->where('name', 'like', '%' . $this->search . '%')
      ->orderBy('created_at', 'desc')
      ->paginate($this->perPage);

    return view('livewire.dashboard.disaster.program.area_of_work.area-of-work-management', ['areaOfWorks' => $areaOfWorks]);
  }

  public function redirectToCreate()
  {
    return redirect()->route('dashboard.disaster.program.areaOfWork.create');
  }

  public function redirectToEdit($areaOfWorkId)
  {
    return redirect()->route('dashboard.disaster.program.areaOfWork.edit', ['areaOfWork' => $areaOfWorkId]);
  }

  public function deleteAreaOfWork($areaOfWorkId)
  {
    $areaOfWork = AreaOfWork::find($areaOfWorkId);
    $areaOfWork->delete();

    session()->flash('title', 'Area of Work Deleted');
    session()->flash('message', 'Area of Work "' . $areaOfWork->name . '" deleted successfully.');

    return redirect()->route('dashboard.disaster.program.areaOfWork');
  }
}
