<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Patient; 
use App\Models\Appointment; 
use App\Models\Prescription; 

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            // Doctor and Admin Stats (from User table)
            'totalDoctors'      => User::where('role', 'doctor')->count(),
            'totalAdmins'       => User::where('role', 'admin')->count(),
            'activeDoctors'     => User::where('role', 'doctor')->where('status', 1)->count(),
            'inactiveDoctors'   => User::where('role', 'doctor')->where('status', 0)->count(),

            // Department Stats
            'totalDepartments'  => Department::count(),
            
            // Patient Stats (from your separate Patient table)
            'totalPatients'     => Patient::count(),
            'activePatients'    => Patient::where('status', 1)->count(),
            'inactivePatients'  => Patient::where('status', 0)->count(),

            // Appointment Stats
            'totalAppointments'   => Appointment::count(),
            'todayAppointments'   => Appointment::whereDate('appointment_date', today())->count(),
            'pendingAppointments' => Appointment::where('status', 'Pending')->count(),

            // FIXED: Removed the $ and = signs to match array key/value formatting
            'totalPrescriptions'  => Prescription::count(),
        ]);
    }
}
