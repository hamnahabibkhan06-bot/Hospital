<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->paginate(10);

        return view(
            'patients.index',
            compact('patients')
        );
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'phone' => 'required',
            'gender' => 'required',
            'age' => 'required|numeric',
            'dob' => 'nullable|date',
            'blood_group' => 'required',
            'address' => 'required',
            'guardian_name' => 'nullable',
            'guardian_phone' => 'nullable',
            'marital_status' => 'nullable',
            'occupation' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $image = null;
        if($request->hasFile('image')){
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('patient-images'), $image);
        }

        $last = Patient::latest()->first();
        if($last){
            $number = (int)substr($last->patient_code, 4) + 1;
        } else {
            $number = 1;
        }

        $patientCode = 'PAT-'.str_pad($number, 5, '0', STR_PAD_LEFT);

        Patient::create([
            'patient_code' => $patientCode,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'age' => $request->age,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'marital_status' => $request->marital_status,
            'occupation' => $request->occupation,
            'image' => $image,
            'status' => 1
        ]);

        return redirect()
            ->route('admin.patients.index') 
            ->with('success', 'Patient Added Successfully');
    }

    public function edit(Patient $patient)
    {
        return view(
            'patients.edit',
            compact('patient')
        );
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'blood_group' => 'required',
            'address' => 'required'
        ]);

        $image = $patient->image;
        if($request->hasFile('image')){
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('patient-images'), $image);
        }

        $patient->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'age' => $request->age,
            'dob' => $request->dob,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'marital_status' => $request->marital_status,
            'occupation' => $request->occupation,
            'image' => $image,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.patients.index') 
            ->with('success', 'Patient Updated');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()
            ->route('admin.patients.index') 
            ->with('success', 'Patient Deleted');
    }
}
