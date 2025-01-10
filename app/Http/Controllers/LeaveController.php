<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LeaveController extends Controller
{
  public function index(Request $request)
  {

    $leaves = Leave::latest()->simplePaginate(7);

    return view('leaves.index', [
      'leaves' => $leaves,
    ]);
  }

  public function create(Request $request)
  {
    $today = Carbon::now()->format('d-m-Y');
    $employee = Auth::user()->employee;
    if (!$employee) {
      abort(404);
    }
    return view('leaves.create', [
      'employee' => $employee,
      'today' => $today
    ]);
  }

  public function store(Request $request)
  {
    $leave_limit = 20;
    $employee = Auth::user()->employee;
    $currentMonth = Carbon::now()->month;


    $starting_date = Carbon::parse($request->start_date);
    $ending_date = Carbon::parse($request->end_date);

    $starting_date->format('d-m-Y');
    $ending_date->format('d-m-Y');

    $days = (int) $starting_date->diffInDays($ending_date) + 1;

    // Sum the number of leave days taken in the current month
    $no_of_leaves = $employee->leaves()
      ->whereMonth('start_date', $currentMonth)
      ->sum('number_of_days');

    $request->validate( [
      'start_date' => [
        'required',
        'date'
      ],
      'end_date' => [
        'required',
        'date'
      ],
      'leave_type' => 'required',
      'reason' => 'required',
    ]);

    if (Carbon::parse($request->start_date)->gt(Carbon::parse($request->end_date))) {
      return redirect('/leaves/create')->with('error', 'Start date cannot be greater than end date.');
    }

    if(($starting_date->month != $currentMonth) || ($ending_date->month != $currentMonth)){ 
      return redirect('/leaves/create')->with('error', 'You can only apply for leave in the current month.');
    }

    if ($starting_date->equalTo($ending_date)) {
      $days = 1;
    }

    if (($no_of_leaves + $days) > $leave_limit) {
      return redirect('/leaves/create')
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
