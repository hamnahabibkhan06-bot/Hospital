<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;

class MyAppointmentController extends Controller
{
    public function index()
    {
        $patient = Patient::where(
            'email',
            auth()->user()->email
        )->first();

        if (!$patient) {
            abort(404);
        }

        $appointments = Appointment::with('doctor')
            ->where('patient_id', $patient->id)
            ->latest()
            ->paginate(10);

        return view(
            'patient.my-appointments',
            compact('appointments')
        );
    }
}