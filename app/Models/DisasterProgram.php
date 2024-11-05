<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'disaster_id',
        'status',
        'image',
        'tor_link',
        'target_donation',
    ];

    public function category()
    {
        return $this->belongsTo(DisasterProgramCategory::class);
    }

    public function disaster()
    {
        return $this->belongsTo(Disaster::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
