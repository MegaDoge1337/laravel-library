<?php

namespace App\Services;

use App\Models\Discount;
use App\Models\GiftDiscount;
use App\User;
use Exception;

class DiscountService
{
    public function giveDiscountForCreateDate(User $user)
    {
        $giftDiscount = GiftDiscount::where('user_id', $user->id)->first() ? true : false;

        if ($giftDiscount && $user->created_at->diffInDays() >= 365) {
            Discount::create([
                'user_id' => $user->id,
                'discount' => 15
            ]);
            try {
                GiftDiscount::where('user_id', $user->id)->delete();
            } catch (Exception $exception) {
                return "{$exception->getCode()}: {$exception->getMessage()}";
            }
        }

        return "Successfully gift discount given";
    }
}
