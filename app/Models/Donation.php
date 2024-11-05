<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_organization',
        'donor_email',
        'amount',
        'message',
        'transfer_evidence',
        'status',
        'donation_date',
        'disaster_program_id'
    ];

    public function disasterProgram()
    {
        return $this->belongsTo(DisasterProgram::class)->withDefault();
    }
}
