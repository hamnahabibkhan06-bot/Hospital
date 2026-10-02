<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $fillable=[

        'patient_id',

        'doctor_id',

        'appointment_date',

        'appointment_time',

        'token_no',

        'problem',

        'status',

        'remarks'

    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function prescription()
    {
    return $this->hasOne(Prescription::class);
    }

}