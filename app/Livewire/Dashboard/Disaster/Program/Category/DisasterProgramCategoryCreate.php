<?php

namespace App\Livewire\Dashboard\Disaster\Program\Category;

use App\Models\DisasterProgramCategory;
use App\Models\AreaOfWork;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Create Disaster Program Category - DMC Ikatek-UH')]
class DisasterProgramCategoryCreate extends Component
{
  use WithFileUploads;

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

  public function save()
  {
    // Validate the inputs
    $this->validate();

    // Handle image uploads
    $cover_image_path = $this->cover_image ? $this->cover_image->store('cover_images', 'public') : null;
    $image_path = $this->image ? $this->image->store('images', 'public') : null;
    $image_galleries_paths = [];
    if ($this->image_galleries) {
      foreach ($this->image_galleries as $image_gallery) {
        $image_galleries_paths[] = $image_gallery->store('image_galleries', 'public');
      }
    }

    // Create the category
    DisasterProgramCategory::create([
      'name' => $this->name,
      'description' => $this->description,
      'short_description' => $this->short_description,
      'cover_image' => $cover_image_path,
      'image' => $image_path,
      'image_galleries' => json_encode($image_galleries_paths), // Store as JSON
      'area_of_work_id' => $this->area_of_work_id,
    ]);

    session()->flash('title', 'Category Created');
    session()->flash('message', 'Disaster Program Category "' . $this->name . '" created successfully.');

    return redirect()->route('dashboard.disaster.program.category');
  }

  public function render()
  {
    // Fetch the available areas of work
    $areas_of_work = AreaOfWork::all();

    return view('livewire.dashboard.disaster.program.category.disaster-program-category-create', [
      'areas_of_work' => $areas_of_work
    ]);
  }
}
