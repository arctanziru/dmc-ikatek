<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;

class Disaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'time_of_disaster',
        'image',
        'image_galleries',
        'city_id',
        'status',
        'user_id',
        'reporter_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function programs()
    {
        return $this->hasMany(DisasterProgram::class);
    }
}
