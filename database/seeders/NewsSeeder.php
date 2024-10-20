<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            "title" => "News 1",
            "image" => "https://via.placeholder.com/150",
            "description" => "Description 1",
            "content" => "<h1>Content 1</h1>",
            "author" => "Author 1",
            "news_category_id" => 1,
        ]);
        News::create([
            "title" => "News 2",
            "image" => "https://via.placeholder.com/150",
            "description" => "Description 2",
            "content" => "<h1>Content 2</h1>",
            "author" => "Author 2",
            "news_category_id" => 2,
        ]);
    }
}
