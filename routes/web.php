<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Payroll;



Route::get('/', [DashboardController::class, 'index']);
// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::prefix('dashboards')->group(function () {
        Route::get('/admin', [DashboardController::class, 'admin'])
            ->can('role-admin');
        Route::get('/employee', [DashboardController::class, 'employee'])
            ->can('user-employee');
    });

    // Employees
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index', 
            'search' => request('search'),
            'sortfield' => request('sortfield'),
            'sortorder' => request('sortorder')
        ])->name('employees.index')
        ->can('viewAny', Employee::class);

        Route::get('/create', [EmployeeController::class, 'create'])
        ->name('employees.create')
        ->can('create', Employee::class);

        Route::post('/store', [EmployeeController::class, 'store'])
        ->name('employees.store')
        ->can('create', Employee::class);

        Route::get('/{employee}', [EmployeeController::class, 'show'])
        ->name('employees.show')
        ->can('view', 'employee');

        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])
        ->can('update', 'employee');

        Route::patch('/{employee}', [EmployeeController::class, 'update'])
        ->can('update', 'employee');

        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])
        ->can('delete', 'employee');
    });

    // Departments
    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index' , 'search' => request('search')])->name('departments.index')
        ->can('viewAny', Department::class);

        Route::get('/create', [DepartmentController::class, 'create'])->name('departments.create')
        ->can('create', Department::class);

        Route::post('/store', [DepartmentController::class, 'store'])
        ->name('departments.store')
        ->can('create', Department::class);

        Route::get('/{department}', [DepartmentController::class, 'show'])
        ->name('departments.show')
        ->can('view', 'department');

        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])
        ->name('departments.edit')
        ->can('update', 'department');

        Route::patch('/{department}', [DepartmentController::class, 'update'])
        ->name('departments.update')
        ->can('update', 'department');

        Route::delete('/{department}', [DepartmentController::class, 'destroy'])
        ->name('departments.destroy')
        ->can('delete', 'department');
    });


    // Leaves
    Route::prefix('leaves')->group(function (){
        Route::get('/', [LeaveController::class, 'index'])
        ->name('leaves.index')
        ->can('viewAny', Leave::class);
        
        Route::get('/create', [LeaveController::class, 'create'])
        ->name('leaves.create')
        ->can('create', Leave::class);

        Route::post('/store', [LeaveController::class, 'store'])
        ->name('leaves.store')
        ->can('create', Leave::class);
        
        Route::get('/{employee}', [LeaveController::class, 'show'])
        ->name('leaves.show')
        ->can('view', 'employee');
        
        Route::get('/{leave}/edit', [LeaveController::class, 'edit'])
        ->name('leaves.edit')
        ->can('update', 'leave');
        
        Route::patch('/{leave}/update', [LeaveController::class, 'update'])
        ->name('leaves.update')
        ->can('update', 'leave');
        
        Route::delete('/{leave}', [LeaveController::class, 'destroy'])
        ->name('leaves.destroy')
        ->can('delete', 'leave');
    });


    // Payrolls
    Route::prefix('payrolls')->group(function () {
        Route::get('/', [PayrollController::class, 'index'])
        ->name('payrolls.index')
        ->can('viewAny', Payroll::class);
        
        Route::get('/create', [PayrollController::class, 'create'])
        ->name('payrolls.create')
        ->can('create', Payroll::class);

        Route::post('/store', [PayrollController::class, 'store'])
        ->name('payrolls.store')
        ->can('create', Payroll::class);
        
        Route::get('/{employee}', [PayrollController::class, 'show'])
        ->name('payrolls.show')
        ->can('view', 'employee');
        
        Route::get('/{payroll}/edit', [PayrollController::class, 'edit'])
        ->name('payrolls.edit')
        ->can('update', 'payroll');
        
        Route::patch('/{payroll}/store', [PayrollController::class, 'update'])
        ->name('payrolls.update')
        ->can('update', 'payroll');
        
        Route::delete('/{payroll}', [PayrollController::class, 'destroy'])
        ->name('payrolls.destroy')
        ->can('delete', 'payroll');
    });
    
    Route::post('/logout', [SessionController::class, 'destroy']);
});


