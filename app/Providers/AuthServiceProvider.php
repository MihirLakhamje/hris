<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\LeavePolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Employee::class, EmployeePolicy::class);
        Gate::policy(Department::class, DepartmentPolicy::class);
        Gate::policy(Leave::class, LeavePolicy::class);
        Gate::define('role-admin', function (User $user): bool {
            return $user->hasRole('admin');
        });
        Gate::define('role-employee', function (User $user): bool {
            return $user->hasRole('employee');
        });
        Gate::define('guest', function (User $user): bool {
            return $user->hasRole('guest');
        });
        Gate::define('user-employee', function (User $user): bool {
            return $user->hasRole('employee') || $user->hasRole('guest');
        });
    }
}
