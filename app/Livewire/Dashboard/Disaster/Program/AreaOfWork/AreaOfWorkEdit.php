<?php

namespace App\Livewire\Dashboard\Disaster\Program\AreaOfWork;

use App\Models\AreaOfWork;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Area of Work - DMC Ikatek-UH')]
class AreaOfWorkEdit extends Component
{
  use WithFileUploads;

  public $areaOfWork;
  public $name;
  public $description;
  public $short_description;
  public $image;
  public $cover_image;

  protected $rules = [
    'name' => 'required|string|max:255|unique:area_of_works,name',
    'description' => 'nullable|string|max:500',
    'short_description' => 'nullable|string|max:255',
    'image' => 'nullable|image|max:5120',
    'cover_image' => 'nullable|image|max:5120',
  ];

  public function mount(AreaOfWork $areaOfWork)
  {
    $this->areaOfWork = $areaOfWork;
    $this->name = $areaOfWork->name;
    $this->description = $areaOfWork->description;
    $this->short_description = $areaOfWork->short_description;
  }

  public function update()
  {
    $this->validate();

    if ($this->image) {
      $imagePath = $this->image->store('images', 'public');
    } else {
      $imagePath = $this->areaOfWork->image;
    }

    if ($this->cover_image) {
      $coverImagePath = $this->cover_image->store('cover_images', 'public');
    } else {
      $coverImagePath = $this->areaOfWork->cover_image;
    }

    $this->areaOfWork->update([
      'name' => $this->name,
      'description' => $this->description,
      'short_description' => $this->short_description,
      'image' => $imagePath,
      'cover_image' => $coverImagePath,
    ]);

    session()->flash('title', 'Area of Work Updated');
    session()->flash('message', 'Area of Work "' . $this->name . '" updated successfully.');

    return redirect()->route('dashboard.disaster.program.areaOfWork');
  }

  public function render()
  {
    return view('livewire.dashboard.disaster.program.area_of_work.area-of-work-edit');
  }
}
