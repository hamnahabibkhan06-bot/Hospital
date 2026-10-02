<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = auth()->user();

        $appointments = Appointment::where('doctor_id', $doctor->id);

        $todayAppointments = (clone $appointments)
            ->whereDate('appointment_date', today())
            ->count();

        $pendingAppointments = (clone $appointments)
            ->where('status', 'Pending')
            ->count();

        $completedAppointments = (clone $appointments)
            ->where('status', 'Completed')
            ->count();

        $totalPatients = Patient::whereHas('appointments', function ($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        })->count();

        $totalPrescriptions = Prescription::whereHas('appointment', function ($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        })->count();

        return view('doctor.dashboard', compact(
            'todayAppointments',
            'pendingAppointments',
            'completedAppointments',
            'totalPatients',
            'totalPrescriptions'
        ));
    }
}