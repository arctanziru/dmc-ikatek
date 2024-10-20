<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "image",
        "news_category_id",
        "description",
        "content",
        "author",
    ];

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public $timestamps = true;
}
