<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
  public function index()
  {
    return view('payrolls.index', [
      'payrolls' => Payroll::with('employee')->simplePaginate(8)
    ]);
  }

  public function create()
  {
    return view('payrolls.create', [
      'employees' => Employee::with('user:id,name,email')->select('id', 'user_id')->get()
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'employee_id' => ['required'],
      'payroll_date' => ['required'],
      'basic_salary' => ['required'],
      'deduction' => ['nullable', 'numeric'],
      'allowance' => ['nullable', 'numeric'],
      'bonus' => ['nullable', 'numeric'],
    ]);

    $formattedPayrollDate = date('d-m-Y', strtotime($request->payroll_date));

    try {
      $payroll = new Payroll([
        'employee_id' => $request->input('employee_id'),
        'payroll_date' => $formattedPayrollDate,
        'basic_salary' => $request->basic_salary,
        'deduction' => $request->deduction,
        'allowance' => $request->allowance,
        'bonus' => $request->bonus,
      ]);

      $payroll->gross_salary = $payroll->calculateGrossSalary();
      $payroll->net_salary = $payroll->calculateNetSalary();

      $payroll->save();
      return redirect('/payrolls')->with('success', 'Payroll created successfully.');
    } catch (\Throwable $th) {
      return redirect('/payrolls/create')->with('error', 'Failed to create payroll.');
    }
  }

  public function show(Employee $employee)
  {
    if (!$employee) {
      abort(404);
    }
    return view('payrolls.show', [
      'payrolls' => $employee->payrolls()->simplePaginate(8),
      'employee' => $employee
    ]);
  }

  public function edit(Request $request, Payroll $payroll)
  {
    return view('payrolls.edit', [
      'payroll' => $payroll
    ]);
  }

  public function update(Request $request, Payroll $payroll)
  {
    if (!$payroll) {
      abort(404);
    }

    $request->validate([
      'payroll_date' => ['required'],
      'basic_salary' => ['required'],
      'deduction' => ['nullable', 'numeric'],
      'allowance' => ['nullable', 'numeric'],
      'bonus' => ['nullable', 'numeric'],
    ]);

    $formattedPayrollDate = date('d-m-Y', strtotime($request->payroll_date));

    $payroll->update([
      'payroll_date' => $formattedPayrollDate,
      'basic_salary' => $request->basic_salary,
      'deduction' => $request->deduction,
      'allowance' => $request->allowance,
      'bonus' => $request->bonus,
    ]);

    $payroll->gross_salary = $payroll->calculateGrossSalary();
    $payroll->net_salary = $payroll->calculateNetSalary();

    $payroll->save();

    return redirect('/payrolls');
  }


  public function destroy(Request $request, Payroll $payroll)
  {
    if (!$payroll) {
      abort(404);
    }

    $payroll->delete();

    return redirect()->back();
  }
}
