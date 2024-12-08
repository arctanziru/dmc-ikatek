<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterProgramCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'image',
        'image_galleries',
        'short_description',
        'area_of_work_id',
    ];

    public function programs()
    {
        return $this->hasMany(DisasterProgram::class, 'category_id');
    }

    public function areaOfWork()
    {
        return $this->belongsTo(AreaOfWork::class, 'area_of_work_id');
    }
}
