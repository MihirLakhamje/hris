<?php

namespace App\Http\Controllers;

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

        $employee->update([
            'address' => $request->address,
            'employee_code' => $request->employee_code,
            'joining_date' => $request->joining_date,
        ]);

        return redirect('/employees/' . $employee->id);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('/employees');
    }
}
