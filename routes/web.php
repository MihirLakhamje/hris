<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

// Employees CRUD
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit']);
Route::patch('/employees/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);

// Departments CRUD
