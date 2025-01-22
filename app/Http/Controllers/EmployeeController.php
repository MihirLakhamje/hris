<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $searchEmployee = $request->query('search');
        $employeesQuery = Employee::with('user');
        if($searchEmployee) {
            $employees = $employeesQuery->whereHas('user', 
            function($query) use ($searchEmployee){
                $query->where('name', 'like', "%$searchEmployee%");
            })->simplePaginate(8);
        }
        $employees = $employeesQuery->simplePaginate(8);
        return view('employees.index', [
            'employees' => $employees,
            'search' => $searchEmployee
        ]);
    }

    public function create()
    {
        $users = User::doesntHave('employee')->get();
        $departments = Department::all();
        $random = 'EMP'.mt_rand(100, 999).date('dY');
        return view('employees.create', [
            'users' => $users,
            'departments' => $departments,
            'random' => $random
        ]);
    }

    public function store(Request $request)
    {   
	try{
	$joiningDate = Carbon::parse($request->joining_date)->format('Y-m-d');
        $request->validate([
            'user_id' => ['required', 'integer'],
            'department_id' => ['required', 'integer'],
            'address' => ['required', 'string', 'max:255'],
            'employee_code' => ['required', 'string', 'max:255', 'min:3'],
            'joining_date' => ['required', 'date'],
            'salary' => ['required', 'numeric'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        $user = User::find($request->user_id);

        Employee::create([
            'user_id' => $request->user_id,
            'department_id' => $request->department_id,
            'address' => $request->address,
            'employee_code' => $request->employee_code,
            'joining_date' => $joiningDate,
            'salary' => $request->salary,
            'phone' => $request->phone,
           
        ]);
        
        $user->role = 'employee';
        $user->save();
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
	}catch(Exception $e){
		dd($e->getMessage());
	}
    }

    public function show(Employee $employee)
    {
        if(!$employee) {
            abort(404);
        }

        return view('employees.show', [
            'employee' => $employee,
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
