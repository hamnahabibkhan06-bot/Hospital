<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [

        'appointment_id',

        'symptoms',

        'diagnosis',

        'medicines',

        'tests',

        'advice',

        'next_visit'

    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}