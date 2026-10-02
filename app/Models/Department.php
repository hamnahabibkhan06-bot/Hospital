<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable=[

        'name',

        'description'

    ];

    public function doctors()
    {
        return $this->hasMany(User::class,'department_id')
            ->where('role','doctor');
    }
}