<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;

class Disaster extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'district_id'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function programs()
    {
        return $this->hasMany(DisasterProgram::class);
    }
}
