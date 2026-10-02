<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient')
            ->where('doctor_id', auth()->id())
            ->latest()
            ->paginate(10);

        
        return view('doctor.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        if ($appointment->doctor_id != auth()->id()) {
            abort(403);
        }
        return view('doctor.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        if ($appointment->doctor_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Pending,Approved,Completed,Cancelled',
            'remarks' => 'nullable|max:500'
        ]);

        $appointment->update([
            'status' => $request->status,
            'remarks' => $request->remarks
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment Updated Successfully'
            ]);
        }

        return back()->with('success', 'Appointment Updated Successfully');
    }
}
