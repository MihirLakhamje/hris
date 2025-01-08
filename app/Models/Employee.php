<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;


    protected $fillable = [
        'phone',
        'address',
        'salary',
        'photo',
        'employee_code',
        'joining_date',
        'user_id',
        'department_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function generateEmployeeCode(){
        return 'EMP' . mt_rand(100, 999).date('Y');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function leaves(){
        return $this->hasMany(Leave::class);
    }

    public function payrolls(){
        return $this->hasMany(Payroll::class);
    }
}
