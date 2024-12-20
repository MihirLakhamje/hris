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
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
