<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index() 
    {
        return view('attendances.index');
    }
    public function create(Employee $employee)
    {
        $mark_date = Carbon::today()->format('d-m-Y');

        return view('attendances.create', [
            'employee' => $employee,
            'mark_date' => $mark_date,
        ]);
    }

    public function store(Request $request, Employee $employee)
    {
        // Validate input
        $request->validate([
            'mark_date' => 'required|date', 
            'status' => 'required|in:present,absent', 
        ]);

        $mark_date = Carbon::parse($request->mark_date)->format('d-m-Y');
        try {
            
            Attendance::where('employee_id', $employee->id)
            ->whereDate('mark_date', $mark_date)
            ->exists();
            
            
            Attendance::create([
                'employee_id' => $employee->id,
                'mark_date' => $mark_date,
                'status' => $request->status,
            ]);
            
            
            return redirect('/employees/' . $employee->id)->with('success', 'Attendance marked successfully.');
        } catch (\Throwable $th) {
            if ($th instanceof QueryException || $th instanceof UniqueConstraintViolationException) {
                return redirect('/attendances/' . $employee->id . '/create')->with('error', 'Attendance already marked for this date.');
            }
           
            return redirect('/attendances/' . $employee->id . '/create')->with('error', 'An error occurred while marking attendance.');
        }

    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', [
            'attendance' => $attendance,
            'employee_id' => $attendance->employee_id,
        ]);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'mark_date' => 'required|date', 
            'status' => 'required|in:present,absent', 
        ]);

        try {
            $attendance->update([
                'mark_date' => $request->mark_date,
                'status' => $request->status,
            ]);
            return redirect('/employees/' . $attendance->employee_id)->with('success', 'Attendance updated successfully.');
        } catch (Exception $th) {
            return redirect('/employees/' . $attendance->employee_id)->with('error', $th->getMessage());
        }
    }

    public function destroy(Attendance $attendance)
    {
        try {
            $attendance->delete();
            return redirect('/employees/' . $attendance->employee_id)->with('success', 'Attendance deleted successfully.');
        } catch (Exception $th) {
            return redirect('/employees/' . $attendance->employee_id)->with('error', 'An error occurred while deleting attendance.');
        }
    }
}

