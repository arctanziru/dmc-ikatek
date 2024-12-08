<?php

namespace App\Livewire\Dashboard\Disaster\Program\AreaOfWork;

use App\Models\AreaOfWork;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Create Area of Work - DMC Ikatek-UH')]
class AreaOfWorkCreate extends Component
{
  use WithFileUploads;

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

  public function save()
  {
    $this->validate();

    $imagePath = $this->image ? $this->image->store('images', 'public') : null;
    $coverImagePath = $this->cover_image ? $this->cover_image->store('cover_images', 'public') : null;

    AreaOfWork::create([
      'name' => $this->name,
      'description' => $this->description,
      'short_description' => $this->short_description,
      'image' => $imagePath,
      'cover_image' => $coverImagePath,
    ]);

    session()->flash('title', 'Area of Work Created');
    session()->flash('message', 'Area of Work "' . $this->name . '" created successfully.');

    return redirect()->route('dashboard.disaster.program.areaOfWork');
  }

  public function render()
  {
    return view('livewire.dashboard.disaster.program.area_of_work.area-of-work-create');
  }
}
