<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

// Employees CRUD
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/create', [EmployeeController::class, 'create']);
Route::post('/employees/store', [EmployeeController::class, 'store']);
Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit']);
Route::patch('/employees/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);

// Departments CRUD
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/create', [DepartmentController::class, 'create']);
Route::post('/departments/store', [DepartmentController::class, 'store']);
Route::get('/departments/{department}', [DepartmentController::class, 'show']);
Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit']);
Route::patch('/departments/{department}', [DepartmentController::class, 'update']);
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy']);
