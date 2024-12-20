<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->simplePaginate(8);
        return view('employees.index', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        $users = User::doesntHave('employee')->get();
        $departments = Department::all();
        $random = 'EMP'.mt_rand(10000, 99999).date('Y');
        return view('employees.create', [
            'users' => $users,
            'departments' => $departments,
            'random' => $random
        ]);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'user_id' => ['required', 'integer'],
            'department_id' => ['required', 'integer'],
            'address' => ['required', 'string', 'max:255'],
            'employee_code' => ['required', 'string', 'max:255', 'min:3'],
            'joining_date' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'phone' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string', 'max:255'],
        ]);

        Employee::create([
            'user_id' => $request->user_id,
            'department_id' => $request->department_id,
            'address' => $request->address,
            'employee_code' => $request->employee_code,
            'joining_date' => $request->joining_date,
            'salary' => $request->salary,
            'phone' => $request->phone,
            'photo' => $request->photo,
        ]);
        return redirect("/employees");
    }

    public function show(Employee $employee)
    {
        if(!$employee) {
            abort(404);
        }

        return view('employees.show', [
            'employee' => $employee
        ]);
    }

    public function edit(Employee $employee) 
    {
        return view('employees.edit', [
            'employee' => $employee
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'employee_code' => ['required', 'string', 'max:255', 'min:3'],
            'joining_date' => ['required', 'string'],
        ]);
        if(!$employee) {
            abort(404);
        }

        $updated = $employee->update([
            'address' => $request->address,
            'employee_code' => $request->employee_code,
            'joining_date' => $request->joining_date,
        ]);

        if(!$updated) {
            abort(500, 'Something went wrong');
        }

        return redirect('/employees/' . $employee->id);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('/employees');
    }
}
