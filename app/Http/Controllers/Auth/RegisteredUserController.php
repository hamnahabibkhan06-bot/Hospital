<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
   
    public function create(): View
    {
        return view('auth.register');
    }

   
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone'     => ['required', 'string', 'max:20'],
            'address'   => ['required', 'string', 'max:255'],
            // 'role'      => ['required', 'in:admin,doctor,patient'],
            'password'  => ['required', 'confirmed', Password::defaults()],
        ]);

       
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            // 'role'      => $request->role,
            'password'  => Hash::make($request->password),
        ]);

       
        // if ($request->role == 'patient') {
            $lastPatient = Patient::latest()->first();

            if ($lastPatient) {
                $number = intval(substr($lastPatient->patient_code, 4)) + 1;
            } else {
                $number = 1;
            }

            $patientCode = 'PAT-' . str_pad($number, 5, '0', STR_PAD_LEFT);

            Patient::create([
                'user_id'      => $user->id,
                'patient_code' => $patientCode,
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'gender'       => 'Not Specified',
                'age'          => 0,
                'blood_group'  => 'Unknown',
                'address'      => $request->address,
                'status'       => 1,
            ]);
        // }

        event(new Registered($user));
        Auth::login($user);
        $request->session()->regenerate();

        // return match ($user->role) {
        //     'admin' => redirect()->route('admin.dashboard'),
        //     'doctor' => redirect()->route('doctor.dashboard'),
        //     default => redirect()->route('patient.dashboard'),
        // };
        return redirect()->route('patient.dashboard');
    }
}
