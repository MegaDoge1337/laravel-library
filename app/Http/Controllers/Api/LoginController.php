<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user)
        {
            return response()->json([
                'error' => "400: User with this email does not exist"
            ]);
        }

        if(!Hash::check($request->password, $user->password))
        {
            return response()->json([
                'error' => "400: Password are incorrect"
            ]);
        }

        $token = $user->createToken('Auth Token')->accessToken;

        return response()->json(['message' => 'Successfully login']);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        return response()->json([
            'message' => 'Successfully logout'
        ]);
    }
}
