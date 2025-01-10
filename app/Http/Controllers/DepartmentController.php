<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $searchDepartment = $request->query('search');
        if($searchDepartment) {
            $departments = Department::where('name', 'like', "%$searchDepartment%")->simplePaginate(8);
        }
        $departments = Department::paginate(8);
        return view('departments.index', [
            'departments' => $departments,
            'search' => $searchDepartment
        ]);
    }

    public function show(Department $department)
    {
        if(!$department) {
            abort(404);
        }

        return view('departments.show', [
            'department' => $department,
            'employees' => $department->employees()->simplePaginate(4)
        ]);
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3', 'unique:departments'],
        ]);

        Department::create([
            'name' => $request->name,
        ]);
        return redirect('/departments');
    }

    public function edit(Department $department) 
    {
        return view('departments.edit', [
            'department' => $department
        ]);
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3', 'unique:departments'],
        ]);
        if(!$department) {
            abort(404);
        }

        $updated = $department->update([
            'name' => $request->name,
        ]);

        if(!$updated) {
            abort(500);
        }

        return redirect('/departments/' . $department->id);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect('/departments');
    }
}
