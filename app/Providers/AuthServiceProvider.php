<?php

namespace App\Providers;

use App\Models\Employee;
use App\Models\User;
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
        Gate::define('role-admin', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('role-employee', function ( $user, $employee) {
            if(!$employee instanceof Employee){
                return false;
            }
            return $user->id === $employee->user_id;
        });
        
        Gate::define('employee-admin', function ($employee) {
            return Gate::allows('role-admin') || Gate::allows('role-employee', $employee);
        });

        Gate::define('employee-ownership', function ( $user,  $employee) {
            if ($user->hasRole('admin')) {
                return true;
            }

            if(!$employee instanceof Employee){
                return false;
            }
        
            return $user->id === $employee->user_id;
        });

        Gate::define('department-access', function ($user, $department){
            if ($user->hasRole('admin')) {
                return true;
            }
            
            return $department->employees->contains('user_id', $user->id);
        });
    }
}
