<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;

        $appointments = Appointment::with('doctor.department')
            ->where('patient_id', $patient->id)
            ->latest()
            ->paginate(10);

        return view(
            'patient.appointments',
            compact('appointments')
        );
    }

    public function create(User $doctor)
    {
        return view(
            'patient.create',
            compact('doctor')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'problem' => 'required|max:1000',
        ]);

        $patient = auth()->user()->patient;

        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();

        if ($exists) {
            return back()->with(
                'error',
                'Selected slot is already booked.'
            );
        }

        $todayCount = Appointment::whereDate(
            'appointment_date',
            $request->appointment_date
        )->count();

        Appointment::create([

            'patient_id' => $patient->id,

            'doctor_id' => $request->doctor_id,

            'appointment_date' => $request->appointment_date,

            'appointment_time' => $request->appointment_time,

            'token_no' => 'T-' . str_pad($todayCount + 1, 3, '0', STR_PAD_LEFT),

            'problem' => $request->problem,

            'status' => 'Pending'

        ]);

        return redirect()
            ->route('patient.appointments')
            ->with(
                'success',
                'Appointment Booked Successfully.'
            );
    }
}
