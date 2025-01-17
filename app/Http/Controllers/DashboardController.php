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
    public function index(){
        if(Auth::check()){
            if(Gate::allows('role-admin')){
                return redirect('/dashboards/admin');
            }
            return redirect('/dashboards/employee');
        }
        return view('welcome');
    }
    public function admin()
    {
        $no_of_employees = Employee::count();
        $no_of_departments = Department::count();
        $no_of_leaves = Leave::where('status', 'pending')->count();
        $no_of_payrolls = Payroll::sum('gross_salary');
        $users = User::whereDoesntHave('employee')->simplePaginate(5);
            return view('dashboards.admin', [
                'no_of_employees' => $no_of_employees,
                'no_of_departments' => $no_of_departments,
                'no_of_leaves' => $no_of_leaves,
                'no_of_payrolls' => $no_of_payrolls, 
                'users' => $users
            ]);
        
    }
    public function employee()
    { 
        $employee = Auth::user()->employee;
        if(!$employee) {
            return view('dashboards.employee', [
                'message' => 'Admin has not created your employee profile yet.'
            ]);
        }
        return view('dashboards.employee', [
            'no_of_leaves_left' => Auth::user()->employee->leaves()->sum('number_of_days'),
            'leaves_limit' => 20,
            'employee' => $employee
        ]);
    }
}
