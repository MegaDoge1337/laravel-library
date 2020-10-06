<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function getUserWallet(Request $request)
    {
        $wallet = [
            'bill' => $request->user()->bill,
            'discounts' => Discount::where('user_id', $request->user()->id)->get()->all()
        ];

        return response()->json($wallet);
    }
}
