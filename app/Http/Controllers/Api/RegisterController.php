<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GiftDiscount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'min:8']
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isAdmin' => 0
        ]);

        GiftDiscount::create(['user_id' => $newUser->id]);

        return response()->json($newUser);
    }
}
