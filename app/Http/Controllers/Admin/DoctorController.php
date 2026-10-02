<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::where('role', 'doctor')->with('department')->latest()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('doctors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'phone'=>'required',
            'address'=>'required',
            'department_id'=>'required',
            'gender'=>'required',
            'age'=>'required|numeric',
            'qualification'=>'required',
            'specialization'=>'required',
            'experience'=>'required',
            'consultation_fee'=>'required',
            'shift'=>'required',
            'password'=>'required|min:8',
            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $image=null;
        if($request->hasFile('image')){
            $image=time().'.'.$request->image->extension();
            $request->image->move(public_path('doctor-images'),$image);
        }

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'department_id'=>$request->department_id,
            'gender'=>$request->gender,
            'age'=>$request->age,
            'qualification'=>$request->qualification,
            'specialization'=>$request->specialization,
            'experience'=>$request->experience,
            'consultation_fee'=>$request->consultation_fee,
            'shift'=>$request->shift,
            'password'=>Hash::make($request->password),
            'role'=>'doctor',
            'image'=>$image,
            'status'=>1
        ]);

        return redirect()->route('admin.doctors.index') 
            ->with('success','Doctor Added Successfully');
    }

    public function edit(User $doctor)
    {
        $departments=Department::all();
        return view('doctors.edit', compact('doctor','departments'));
    }

    public function update(Request $request, User $doctor)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$doctor->id,
            'phone'=>'required',
            'address'=>'required',
            'department_id'=>'required',
            'qualification'=>'required',
            'specialization'=>'required',
            'experience'=>'required',
            'consultation_fee'=>'required',
            'shift'=>'required'
        ]);

        $image=$doctor->image;
        if($request->hasFile('image')){
            $image=time().'.'.$request->image->extension();
            $request->image->move(public_path('doctor-images'),$image);
        }

        $doctor->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'department_id'=>$request->department_id,
            'qualification'=>$request->qualification,
            'specialization'=>$request->specialization,
            'experience'=>$request->experience,
            'consultation_fee'=>$request->consultation_fee,
            'shift'=>$request->shift,
            'image'=>$image,
            'status'=>$request->status
        ]);

        return redirect()
            ->route('admin.doctors.index') 
            ->with('success','Doctor Updated');
    }

    public function destroy(User $doctor)
    {
        $doctor->delete();

        return redirect()
            ->route('admin.doctors.index') 
            ->with('success','Doctor Deleted');
    }
}
