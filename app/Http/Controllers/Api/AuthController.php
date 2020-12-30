<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $login_data = ['name'=> $request->name,
        'password'=>$request->password];
        if (Auth::attempt($login_data)){
            $user = Auth::user();
            $token = $user->createToken('Token')->accessToken;
            return response([
                'status'=>'success',
                'token'=>$token
            ]);
        }
        return response([
           'status'=>'error',
            'message'=>'invalid login try again'
        ]);
    }
}
