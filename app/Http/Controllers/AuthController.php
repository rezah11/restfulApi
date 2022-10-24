<?php

namespace App\Http\Controllers;


use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
//        $a='guard';
//        dd(auth()->guard('api'));
//        dd($request->password);
        auth()->attempt([
            'email' => $request->username,
            'password' => $request->password
        ]);

        if (auth()->check()) {
//            dd(auth()->check());
            return response([
                'token' => auth()->user()->generatetoken(),
            ]);
//            return auth()->user()->generatetoken();
        }
//        dd($request->email);
        return response([
            'error' => 'اطلاعات کاربری اشتباه وارد شده است'
        ], 401);
    }

    public function logout()
    {
        $user = auth()->guard('api')->user();
        $user->logout();
        return $user;
    }

    public function user()
    {
        return auth('api')->user();
    }
}
