<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
  public function index()
  {
    $leaves = Leave::with('employee')->simplePaginate(8);
    // dd($leaves[0]);
    return view('leaves.index', [
      'leaves' => $leaves,
    ]);
  }

  public function create(Request $request, Employee $employee)
  {
    $today = Carbon::now()->format('d-m-Y');
    // dd($employee->id);
    if (!$employee) {
      abort(404);
    }
    Gate::authorize('employee-ownership', $employee);
    return view('leaves.create', [
      'employee' => $employee,
      'today' => $today
    ]);
  }

  public function store(Request $request, Employee $employee)
  {
    $leave_limit = 20;
    $no_of_leaves = $employee->leaves()->sum('number_of_days');
    $validation = Validator::make($request->all(), [
      'start_date' => 'required',
      'end_date' => 'required',
      'leave_type' => 'required',
      'reason' => 'required',
    ]);


    if ($validation->fails()) {
      return redirect('/leaves/' . $employee->id . '/create')->with('error', 'All fields are required.');
    }

    if (Carbon::parse($request->start_date)->gt(Carbon::parse($request->end_date))) {
      return redirect('/leaves/' . $employee->id . '/create')->with('error', 'Start date cannot be greater than end date.');
    }

    $starting_date = Carbon::parse($request->start_date);
    $ending_date = Carbon::parse($request->end_date);

    $starting_date->format('d-m-Y');
    $ending_date->format('d-m-Y');

    $days = (int) $starting_date->diffInDays($ending_date) + 1;
    if($starting_date->equalTo($ending_date)){
      $days = 1;
    }
    // dd($starting_date, $ending_date, $days);

    if (($no_of_leaves + $days) > $leave_limit) {
      return redirect('/leaves/' . $employee->id . '/create')
        ->with('error', 'Leave request exceeds the allowed limit of 20 days.');
    }

    Leave::create([
      'employee_id' => $employee->id,
      'start_date' => date('d-m-Y', strtotime($request->start_date)),
      'end_date' => date('d-m-Y', strtotime($request->end_date)),
      'leave_type' => $request->input('leave_type'),
      'reason' => $request->input('reason'),
      'number_of_days' => $days
    ]);

    Gate::authorize('employee-ownership', $employee);

    if (Gate::check('role-admin')) {
      return redirect('/leaves')->with('success', 'Leave applied successfully.');
    }
    return redirect('/leaves/' . $employee->id)->with('success', 'Leave applied successfully.');

  }

  public function show(Employee $employee)
  {
    return view('leaves.show', [
      'leaves' => $employee->leaves()->latest()->simplePaginate(8),
      'employee' => $employee
    ]);
  }

  public function edit(Leave $leave)
  {
    return view('leaves.edit', compact('leave'));
  }

  public function update(Request $request, Leave $leave)
  {
    // dd($request->all());
    $request->validate([
      'status' => 'required',
    ]);

    $leave->update([
      'employee_id' => $leave->employee_id,
      'status' => $request->status,
    ]);

    return redirect('/leaves');
  }

  public function destroy(Leave $leave)
  {
    $leave->delete();

    return redirect()->back();
  }
}
