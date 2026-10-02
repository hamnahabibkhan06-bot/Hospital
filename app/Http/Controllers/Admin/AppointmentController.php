<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient', 'doctor')
            ->latest()
            ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = User::where('role', 'doctor')
            ->orderBy('name')
            ->get();

        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'problem' => 'required|max:500'
        ]);

        $last = Appointment::latest()->first();
        if ($last) {
            $number = (int)substr($last->token_no, 3) + 1;
        } else {
            $number = 1;
        }

        $token = 'TK-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'problem' => $request->problem,
            'status' => 'Pending',
            'remarks' => $request->remarks,
            'token_no' => $token
        ]);

        return redirect()
            ->route('admin.appointments.index') 
            ->with('success', 'Appointment Created Successfully');
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = User::where('role', 'doctor')
            ->orderBy('name')
            ->get();

        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'problem' => 'required'
        ]);

        $appointment->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'problem' => $request->problem,
            'remarks' => $request->remarks,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.appointments.index') 
            ->with('success', 'Appointment Updated');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index') 
            ->with('success', 'Appointment Deleted');
    }
}
