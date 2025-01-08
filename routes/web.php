<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

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


    // Leaves
    Route::prefix('leaves')->group(function (){
        Route::get('/', [LeaveController::class, 'index'])
        ->can('role-admin');
        
        Route::get('/{employee}/create', [LeaveController::class, 'create'])
        ->can('employee-ownership', 'employee');

        Route::post('/{employee}/store', [LeaveController::class, 'store'])
        ->can('employee-ownership', 'employee');
        
        Route::get('/{employee}', [LeaveController::class, 'show'])
        ->can('role-employee', 'employee');
        
        Route::get('/{leave}/edit', [LeaveController::class, 'edit'])
        ->can('role-admin');
        
        Route::patch('/{leave}/update', [LeaveController::class, 'update'])
        ->can('role-admin');
        
        Route::delete('/{leave}', [LeaveController::class, 'destroy'])
        ->can('delete-leave', 'leave');
    });


    // Payrolls
    Route::prefix('payrolls')->group(function () {
        Route::get('/', [PayrollController::class, 'index'])
        ->can('role-admin');
        
        Route::get('/create', [PayrollController::class, 'create'])
        ->can('role-admin');

        Route::post('/store', [PayrollController::class, 'store'])
        ->can('role-admin');
        
        Route::get('/{employee}', [PayrollController::class, 'show'])
        ->can('role-employee', 'employee');
        
        Route::get('/{payroll}/edit', [PayrollController::class, 'edit'])
        ->can('role-admin');
        
        Route::patch('/{payroll}/store', [PayrollController::class, 'update'])
        ->can('role-admin');
        
        Route::delete('/{payroll}', [PayrollController::class, 'destroy'])
        ->can('role-admin');
    });
    
    Route::post('/logout', [SessionController::class, 'destroy']);
});


// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);