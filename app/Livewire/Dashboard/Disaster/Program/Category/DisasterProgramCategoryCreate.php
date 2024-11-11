<?php

namespace App\Livewire\Dashboard\Disaster\Program\Category;

use App\Models\DisasterProgramCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Create Disaster Program Category - DMC Ikatek-UH')]
class DisasterProgramCategoryCreate extends Component
{
  public $name;
  public $description;

  protected $rules = [
    'name' => 'required|string|max:255|unique:disaster_program_categories,name',
    'description' => 'nullable|string|max:500',
  ];

  public function save()
  {
    $this->validate();

    DisasterProgramCategory::create([
      'name' => $this->name,
      'description' => $this->description,
    ]);

    session()->flash('title', 'Category Created');
    session()->flash('message', 'Disaster Program Category "' . $this->name . '" created successfully.');

    return redirect()->route('dashboard.disaster.program.category');
  }

  public function render()
  {
    return view('livewire.dashboard.disaster.program.category.disaster-program-category-create');
  }
}
