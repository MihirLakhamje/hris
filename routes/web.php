<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Gate;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // Employees
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);

        Route::get('/create', [EmployeeController::class, 'create'])
            ->can('role-admin');

        Route::post('/store', [EmployeeController::class, 'store'])
            ->can('role-admin');

        Route::get('/{employee}', [EmployeeController::class, 'show'])
            ->can('role-admin');

        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])
            ->can('role-admin');

        Route::patch('/{employee}', [EmployeeController::class, 'update'])
            ->can('role-admin');

        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])
            ->can('role-admin');
    });

    // Departments
    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index']);

        Route::get('/create', [DepartmentController::class, 'create'])
            ->can('role-admin');

        Route::post('/store', [DepartmentController::class, 'store'])
            ->can('role-admin');

        Route::get('/{department}', [DepartmentController::class, 'show'])
            ->can('role-admin');

        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])
            ->can('role-admin');

        Route::patch('/{department}', [DepartmentController::class, 'update'])
            ->can('role-admin');

        Route::delete('/{department}', [DepartmentController::class, 'destroy'])
            ->can('role-admin');
    });

    // Attendances
    Route::prefix('attendances')->group(function (){
        Route::get('/', [AttendanceController::class, 'index'])
        ->can('role-admin');
        
        Route::post('/{employee}/store', [AttendanceController::class, 'store'])
        ->can('role-admin');

        Route::get('/{employee}/create', [AttendanceController::class, 'create'])
        ->can('role-admin');

        Route::get('/{employee}', [AttendanceController::class, 'show'])
        ->can('role-employee', 'employee');
        
        Route::get('/{attendance}/edit', [AttendanceController::class, 'edit'])
        ->can('role-admin');
        
        Route::patch('/{attendance}/update', [AttendanceController::class, 'update'])
        ->can('role-admin');
        
        Route::delete('/{attendance}', [AttendanceController::class, 'destroy'])
        ->can('role-admin');
    });

    // Leaves
    Route::prefix('leaves')->group(function (){
        Route::get('/', [LeaveController::class, 'index'])
        ->can('role-admin');
        
        Route::post('/{employee}/store', [LeaveController::class, 'store'])
        ->can('employee-ownership', 'employee');
        
        Route::get('/{employee}/create', [LeaveController::class, 'create'])
        ->can('employee-ownership', 'employee');
        
        Route::get('/{employee}', [LeaveController::class, 'show'])
        ->can('role-employee', 'employee');
        
        Route::get('/{leave}/edit', [LeaveController::class, 'edit'])
        ->can('employee-ownership', 'employee');
        
        Route::patch('/{leave}/update', [LeaveController::class, 'update'])
        ->can('employee-ownership', 'employee');
        
        Route::delete('/{leave}', [LeaveController::class, 'destroy'])
        ->can('employee-ownership', 'employee');
    });
    
    Route::post('/logout', [SessionController::class, 'destroy']);
});


// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);