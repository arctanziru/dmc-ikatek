<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterProgramCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function programs()
    {
        return $this->hasMany(DisasterProgram::class, 'category_id');
    }
}
