<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        if(Gate::allows('role-admin')){
            $no_of_employees = Employee::count();
            $no_of_departments = Department::count();
            $no_of_leaves = Leave::count();
            return view('welcome',  [
                'no_of_employees' => $no_of_employees,
                'no_of_departments' => $no_of_departments,
                'no_of_leaves' => $no_of_leaves,
            ]);
        }

            $no_of_leaves_left = Auth::user()->employee->leaves()->sum('number_of_days');
            $leaves_limit = 20;
            $employee = Auth::user()->employee;
        
        

        return view('welcome',  [
            'no_of_leaves_left' => $no_of_leaves_left,
            'leaves_limit' => $leaves_limit,
            'employee' => $employee
        ]);
    }
}
