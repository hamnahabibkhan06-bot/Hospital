<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Department;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctors = User::where('role','doctor')

        ->when(

            $request->search,

            function($q) use($request)
            {
                $q->where(

                    'name',

                    'like',

                    '%'.$request->search.'%'

                );
            }

        )

        ->when(

            $request->department,

            function($q) use($request)
            {
                $q->where(

                    'department_id',

                    $request->department

                );
            }

        )

        ->with('department')

        ->paginate(9);

        return view(

            'patient.doctors',

            [

                'doctors'=>$doctors,

                'departments'=>Department::all()

            ]

        );
    }
}