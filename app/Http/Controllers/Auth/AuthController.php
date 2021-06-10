<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Auth::attempt($request->only('email', 'password'))) {
                $token = $user->createToken('api-user')->accessToken;

                return response()->json([
                    "success"       => true,
                    "message"       => "Success, use the access_token for future references",
                    "access_token"    => $token,
                ]);
            }

            return response()->json([
                "success"       => false,
                "message"       => "Wrong Password",
                "error_code"    => "FXCZ5D",
            ]);

        }

        return response()->json([
            "success"       => false,
            "error_code"    => "0XCV5J",
            "message"       => "No user found With the given credential",
        ]);
    }


    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'unique:users|email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('api-user')->accessToken;

        return  response()->json([
            "success"        => true,
            "message"       => "Account created successfully",
            "access_token"    => $token,
        ]);
    }
}
