<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DiscountService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected DiscountService $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

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

        $this->discountService->giveDiscountForCreateDate($user);

        return response()
            ->json(['message' => 'Successfully login'])
            ->cookie('token', $token, 60);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        if(Cookie::get('token'))
        {
            Cookie::forget('token');
        }

        return response()->json([
            'message' => 'Successfully logout'
        ]);
    }
}
