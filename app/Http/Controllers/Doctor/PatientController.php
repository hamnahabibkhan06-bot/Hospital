<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $doctor = auth()->user();

       
        $patients = Patient::whereHas('appointments', function ($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        })
        ->withCount(['appointments' => function ($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        }])
        ->latest()
        ->paginate(10);

       
        return view('doctor.patients.index', compact('patients'));
    }

    
    public function show(Patient $patient)
    {
        $doctorId = auth()->id();

        
        $patient->load([
            'appointments' => function ($q) use ($doctorId) {
                $q->where('doctor_id', $doctorId)->latest();
            },
            'appointments.prescription' 
        ]);

        return view('doctor.patients.show', compact('patient'));
    }
}
