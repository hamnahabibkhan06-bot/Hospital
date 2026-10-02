<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [

        'name',
        'email',
        'phone',
        'address',
        'password',

        'role',

        'department_id',

        'gender',

        'age',

        'qualification',

        'specialization',

        'experience',

        'consultation_fee',

        'shift',

        'image',

        'status',

    ];

    protected $hidden = [

        'password',

        'remember_token',

    ];

    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

        ];
    }

    

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

  

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    

    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
