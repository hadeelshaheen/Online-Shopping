<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('Dashboard.login');
    }
    public function authenticate(Request $request){
        dd($request->toArray());
        $login_data = ['email'=>$request->name ,
            'password'=>$request->password];
        if (Auth::attempt($login_data)){
            return redirect()->route('dashboard.dashboard');
        }
        return redirect()->with('error','login invalid');
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('pages.index');
    }
}
