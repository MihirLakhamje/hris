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

        Gate::define('employee-ownership', function ( $user,  $employee) {
            return $user->id === $employee->user_id || $user->hasRole('admin');
        });


        Gate::define('delete-leave', function ($user, $leave) {
            // Allow if the user is the employee who owns the leave or is an admin
            return $user->id === $leave->employee->user_id;
        });
    }
}
