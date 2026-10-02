<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // $departments = Department::latest()->paginate(10);
$departments = Department::latest()->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Department::create($request->all());

        return redirect()
            ->route('admin.departments.index') 
            ->with('success', 'Department created successfully');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $department->update($request->all());

        return redirect()
            ->route('admin.departments.index') 
            ->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()
            ->route('admin.departments.index') 
            ->with('success', 'Department deleted successfully');
    }
}
