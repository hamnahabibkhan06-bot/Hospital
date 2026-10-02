<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Appointment;

class PrescriptionController extends Controller
{
    public function index()
    {
        $doctor = auth()->user();

        $prescriptions = Prescription::whereHas('appointment', function ($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        })
        ->with(['appointment.patient'])
        ->latest()
        ->paginate(10);

        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    public function create()
{
    $appointments = Appointment::where('doctor_id', auth()->id())
        ->where('status', 'Completed')
        ->doesntHave('prescription')
        ->with('patient')
        ->get();

    return view('doctor.prescriptions.create', compact('appointments'));
}

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id'=>'required|exists:appointments,id',
            'symptoms'=>'required',
            'diagnosis'=>'required',
            'medicines'=>'required',
            'tests'=>'nullable',
            'advice'=>'nullable',
            'next_visit'=>'nullable|date'
        ]);

        
        $appointment = Appointment::findOrFail($request->appointment_id);
        if ($appointment->doctor_id != auth()->id()) {
            abort(403);
        }

        Prescription::create($request->all());

        return redirect()
            ->route('doctor.prescriptions.index')
            ->with('success','Prescription Created');
    }

    public function edit(Prescription $prescription)
    {
        if ($prescription->appointment->doctor_id != auth()->id()) {
            abort(403);
        }
        return view('doctor.prescriptions.edit', compact('prescription'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        if ($prescription->appointment->doctor_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'symptoms'=>'required',
            'diagnosis'=>'required',
            'medicines'=>'required'
        ]);

        $prescription->update($request->all());

        return redirect()
            ->route('doctor.prescriptions.index')
            ->with('success','Prescription Updated');
    }

    public function destroy(Prescription $prescription)
    {
        if ($prescription->appointment->doctor_id != auth()->id()) {
            abort(403);
        }

        $prescription->delete();

        return back()->with('success','Prescription Deleted');
    }

    public function show(Prescription $prescription)
    {
        if ($prescription->appointment->doctor_id != auth()->id()) {
            abort(403);
        }
        return view('doctor.prescriptions.show', compact('prescription'));
    }
}
