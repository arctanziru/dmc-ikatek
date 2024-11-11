<?php

namespace App\Livewire\Dashboard\Disaster\Program\Category;

use App\Models\DisasterProgramCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Disaster Program Category - DMC Ikatek-UH')]
class DisasterProgramCategoryEdit extends Component
{
  public $category;
  public $name;
  public $description;

  protected $rules = [
    'name' => 'required|string|max:255|unique:disaster_program_categories,name',
    'description' => 'nullable|string|max:500',
  ];

  public function mount(DisasterProgramCategory $category)
  {
    $this->category = $category;
    $this->name = $category->name;
    $this->description = $category->description;
  }

  public function update()
  {
    $this->validate([
      'name' => 'required|string|max:255|unique:disaster_program_categories,name,' . $this->category->id,
      'description' => 'nullable|string|max:500',
    ]);

    $this->category->update([
      'name' => $this->name,
      'description' => $this->description,
    ]);

    session()->flash('title', 'Category Updated');
    session()->flash('message', 'Disaster Program Category "' . $this->name . '" updated successfully.');

    return redirect()->route('dashboard.disaster.program.category');
  }

  public function render()
  {
    return view('livewire.dashboard.disaster.program.category.disaster-program-category-edit');
  }
}
