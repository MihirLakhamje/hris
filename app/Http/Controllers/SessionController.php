<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        if(Auth::check()){
            if(Gate::allows('role-admin')){
                return redirect('/dashboards/admin');
            }
            return redirect('/dashboards/employee');
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);
        }

        $request->session()->regenerate();

        if(Gate::allows('role-admin')){ 
            return redirect('/dashboards/admin');
        }
        return redirect('/dashboards/employee');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login');
    }
}
