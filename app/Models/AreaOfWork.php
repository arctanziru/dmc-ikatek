<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaOfWork extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'short_description',
        'image',
        'cover_image'
    ];

    public function disasterProgramCategories()
    {
        return $this->hasMany(DisasterProgramCategory::class);
    }
}
