<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\PrescriptionController;

use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Patient\DoctorController as PatientDoctorController;
use App\Http\Controllers\Patient\MyAppointmentController;
use App\Http\Controllers\Doctor\PrescriptionController as DoctorPrescriptionController;


use App\Http\Controllers\Doctor\PatientController as DoctorPatientController;


use App\Http\Controllers\Patient\AppointmentController as PatientAppointmentController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            default => redirect()->route('patient.dashboard'),
        };
    })->name('dashboard');
});


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::view('/reports', 'reports.index')
            ->name('reports.index');

        Route::resource('departments', DepartmentController::class);
        Route::resource('doctors', DoctorController::class);
        Route::resource('patients', PatientController::class);
        Route::resource('appointments', AppointmentController::class);
        Route::resource('prescriptions', PrescriptionController::class);
    });


Route::middleware(['auth', 'role:doctor'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {

        
        Route::get('/dashboard', [DoctorDashboardController::class, 'index'])
            ->name('dashboard');

       

        Route::resource('appointments', DoctorAppointmentController::class);

        Route::patch(
            'appointments/{appointment}/status',
            [DoctorAppointmentController::class, 'updateStatus']
        )->name('appointments.status');

        

        Route::resource('patients', DoctorPatientController::class)
            ->only(['index', 'show']);

       
        Route::resource('prescriptions', DoctorPrescriptionController::class);

    });


Route::middleware(['auth', 'role:patient'])
    ->prefix('patient')
    ->name('patient.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [PatientDashboardController::class, 'index']
        )->name('dashboard');

        Route::get(
            '/doctors',
            [\App\Http\Controllers\Patient\DoctorController::class, 'index']
        )->name('doctors');

        Route::get(
            '/appointments',
            [\App\Http\Controllers\Patient\AppointmentController::class, 'index']
        )->name('appointments');

        Route::get(
            '/appointments/create/{doctor}',
            [\App\Http\Controllers\Patient\AppointmentController::class, 'create']
        )->name('appointments.create');

        Route::post(
            '/appointments',
            [\App\Http\Controllers\Patient\AppointmentController::class, 'store']
        )->name('appointments.store');

        Route::get(
            '/prescriptions',
            [\App\Http\Controllers\Patient\PrescriptionController::class, 'index']
        )->name('prescriptions');

        Route::get(
            '/prescriptions/{prescription}',
            [\App\Http\Controllers\Patient\PrescriptionController::class, 'show']
        )->name('prescriptions.show');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
