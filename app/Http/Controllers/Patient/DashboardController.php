<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;

class DashboardController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;

        if (!$patient) {
            return view('patient.dashboard', [
                'appointments'  => 0,
                'pending'       => 0,
                'completed'     => 0,
                'prescriptions' => 0,
            ]);
        }

        return view('patient.dashboard', [
            'appointments'  => Appointment::where('patient_id', $patient->id)->count(),
            'pending'       => Appointment::where('patient_id', $patient->id)->where('status', 'Pending')->count(),
            'completed'     => Appointment::where('patient_id', $patient->id)->where('status', 'Completed')->count(),
            'prescriptions' => Prescription::whereHas('appointment', function($q) use ($patient) {
                $q->where('patient_id', $patient->id);
            })->count(),
        ]);
    }
}
