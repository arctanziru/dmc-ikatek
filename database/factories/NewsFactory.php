<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = News::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      "title" => $this->faker->sentence(),
      "image" => $this->faker->imageUrl(),
      "description" => $this->faker->paragraph(),
      "content" => $this->faker->paragraphs(3, true),
      "author" => $this->faker->name(),
      "news_category_id" => NewsCategory::factory(),
    ];
  }
}
