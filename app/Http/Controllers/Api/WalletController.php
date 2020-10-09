<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DiscountService;
use App\Services\PaymentCalculator;
use App\User;
use Exception;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected PaymentCalculator $paymentCalculator;
    protected DiscountService $discountService;

    public function __construct(PaymentCalculator $paymentCalculator, DiscountService $discountService)
    {
        $this->paymentCalculator = $paymentCalculator;
        $this->discountService = $discountService;
    }

    public function getUserWallet(Request $request)
    {
        $wallet = [
            'bill' => $request->user()->bill
        ];

        return response()->json($wallet);
    }

    public function makeUserPayment(Request $request)
    {
        $request->validate([
            'price' => ['required']
        ]);

        $this->discountService->giveDiscountForCreateDate($request->user());

        $bill = $request->user()->bill;
        $price = $request->price;
        $discount = $request->user()->discount()->first() ?? 0; // If discount not exist: discount = 0

        try {
            $bill = $this->paymentCalculator->calculatePayment($bill, $price, $discount->discount); // Calculate paymanet and return the remainder of bill
        } catch (Exception $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        User::find($request->user()->id)->setAttribute('bill', $bill)->save(); // Save bill in db
        return response()->json($bill);
    }
}
