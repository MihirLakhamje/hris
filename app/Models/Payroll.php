<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payroll_date',
        'basic_salary',
        'gross_salary',
        'net_salary',
        'deduction',
        'allowance',
        'bonus',
    ];

    public function calculateGrossSalary()
    {
        return  $this->basic_salary + ($this->allowance ?? 0) + ($this->bonus ?? 0);
    }

    public function calculateNetSalary()
    {
        return $this->gross_salary - ($this->deduction ?? 0);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
