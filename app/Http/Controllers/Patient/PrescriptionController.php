<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;

use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;

        $prescriptions = Prescription::with(
            'appointment.doctor',
            'appointment.patient'
        )

        ->whereHas(
            'appointment',
            function($q) use($patient)
            {
                $q->where(
                    'patient_id',
                    $patient->id
                );
            }
        )

        ->latest()

        ->paginate(10);

        return view(
            'patient.prescriptions',
            compact('prescriptions')
        );
    }

    public function show(Prescription $prescription)
    {
        return view(
            'patient.show',
            compact('prescription')
        );
    }
}