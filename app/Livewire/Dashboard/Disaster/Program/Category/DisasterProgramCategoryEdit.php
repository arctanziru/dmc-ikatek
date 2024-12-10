<?php

namespace App\Livewire\Dashboard\Disaster\Program\Category;

use App\Models\DisasterProgramCategory;
use App\Models\AreaOfWork;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Edit Disaster Program Category - DMC Ikatek-UH')]
class DisasterProgramCategoryEdit extends Component
{
  use WithFileUploads;

  public $category;
  public $name;
  public $description;
  public $short_description;
  public $cover_image;
  public $image;
  public $image_galleries = [];
  public $area_of_work_id;

  // Validation rules
  protected $rules = [
    'name' => 'required|string|max:255|unique:disaster_program_categories,name',
    'description' => 'nullable|string|max:500',
    'short_description' => 'nullable|string|max:255',
    'cover_image' => 'nullable|image|max:5120',
    'image' => 'nullable|image|max:5120',
    'image_galleries.*' => 'nullable|image|max:5120',
    'area_of_work_id' => 'required|exists:area_of_works,id',
  ];

  public function mount(DisasterProgramCategory $category)
  {
    $this->category = $category;
    $this->name = $category->name;
    $this->description = $category->description;
    $this->short_description = $category->short_description;
    $this->area_of_work_id = $category->area_of_work_id;

    // Populate image fields if they exist
    $this->cover_image = $category->cover_image;
    $this->image = $category->image;
    $this->image_galleries = json_decode($category->image_galleries) ?: [];
  }

  public function update()
  {
    $this->validate(
      [
        ...$this->rules,
        'name' => 'required|string|max:255|unique:disaster_program_categories,name,' . $this->category->id,
      ]
    );

    // Handle image uploads (if any)
    $cover_image_path = $this->cover_image ? $this->cover_image->store('cover_images', 'public') : $this->category->cover_image;
    $image_path = $this->image ? $this->image->store('images', 'public') : $this->category->image;
    $image_galleries_paths = [];
    if ($this->image_galleries) {
      foreach ($this->image_galleries as $image_gallery) {
        $image_galleries_paths[] = $image_gallery->store('image_galleries', 'public');
      }
    }

    // Update the category
    $this->category->update([
      'name' => $this->name,
      'description' => $this->description,
      'short_description' => $this->short_description,
      'cover_image' => $cover_image_path,
      'image' => $image_path,
      'image_galleries' => json_encode($image_galleries_paths), // Store as JSON
      'area_of_work_id' => $this->area_of_work_id,
    ]);

    session()->flash('title', 'Category Updated');
    session()->flash('message', 'Disaster Program Category "' . $this->name . '" updated successfully.');

    return redirect()->route('dashboard.disaster.program.category');
  }

  public function render()
  {
    // Fetch the available areas of work
    $areas_of_work = AreaOfWork::all();

    return view('livewire.dashboard.disaster.program.category.disaster-program-category-edit', [
      'areas_of_work' => $areas_of_work
    ]);
  }
}
