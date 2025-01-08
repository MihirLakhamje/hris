<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        
        if(Gate::allows('role-admin')) {
            $no_of_employees = Employee::count();
            $no_of_departments = Department::count();
            $no_of_leaves = Leave::where('status', 'pending')->count();
            $no_of_payrolls = Payroll::sum('gross_salary');
            $users = User::whereDoesntHave('employee')->simplePaginate(5);
            return view('welcome', [
                'no_of_employees' => $no_of_employees,
                'no_of_departments' => $no_of_departments,
                'no_of_leaves' => $no_of_leaves,
                'no_of_payrolls' => $no_of_payrolls, 
                'users' => $users
            ]);
        }
        
        if(Gate::allows('role-employee', [Auth::user(),Auth::user()->employee])) {
            $no_of_leaves_left = Auth::user()->employee->leaves()->sum('number_of_days');
            $leaves_limit = 20;
            $employee = Auth::user()->employee;
            return view('welcome', [
                'no_of_leaves_left' => $no_of_leaves_left,
                'leaves_limit' => $leaves_limit,
                'employee' => $employee
            ]);
        }

        if(Gate::denies('role-employee', [Auth::user(), Auth::user()->employee]) && Gate::denies('role-admin')) {
            return view('welcome', [
                'message' => 'Please wait for the admin to approve your account'
            ]);
        }

    }
}
