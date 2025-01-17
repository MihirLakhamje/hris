<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RegisteredUserController extends Controller
{
    public function create(){
        if(Auth::check()){
            if(Gate::allows('role-admin')){
                return redirect('/dashboards/admin');
            }
            return redirect('/dashboards/employee');
        }
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user);

        if(!Auth::check()){
            return redirect('/login');
        }

        if(Gate::allows('role-admin')){ 
            return redirect('/dashboards/admin');
        }
        return redirect('/dashboards/employee');
    }
}
