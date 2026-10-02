<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::with(
            'appointment.patient',
            'appointment.doctor'
        );

        if ($request->ajax()) {

            if ($request->search) {

                $search = $request->search;

                $query->whereHas('appointment.patient', function ($q) use ($search) {

                    $q->where('name', 'LIKE', "%{$search}%");
                })->orWhereHas('appointment.doctor', function ($q) use ($search) {

                    $q->where('name', 'LIKE', "%{$search}%");
                });
            }

            $prescriptions = $query->latest()->get();

            return response()->json($prescriptions);
        }

        $prescriptions = $query->latest()->paginate(10);

        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        
        $appointments = Appointment::with('patient', 'doctor')
            ->where('status', 'Completed')
            ->get();

        return view('prescriptions.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'medicines' => 'required'
        ]);

        Prescription::create($request->all());

        return redirect()
            ->route('admin.prescriptions.index') 
            ->with('success', 'Prescription Created');
    }

    
    public function show(Prescription $prescription)
    {
        $prescription->load('appointment.patient', 'appointment.doctor');

        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $appointments = Appointment::with('patient', 'doctor')->get();

        return view('prescriptions.edit', compact('prescription', 'appointments'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'appointment_id' => 'required',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'medicines' => 'required'
        ]);

        $prescription->update($request->all());

        return redirect()
            ->route('admin.prescriptions.index')
            ->with('success', 'Prescription Updated');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        if (request()->ajax()) {

            return response()->json([
                'success' => true
            ]);
        }

        return redirect()
            ->route('admin.prescriptions.index')
            ->with('success', 'Prescription Deleted');
    }
}
