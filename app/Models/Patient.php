<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable=[
        'user_id',
        'patient_code',
        'name',
        'email',
        'phone',
        'gender',
        'age',
        'dob',
        'blood_group',
        'address',
        'guardian_name',
        'guardian_phone',
        'marital_status',
        'occupation',
        'image',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}