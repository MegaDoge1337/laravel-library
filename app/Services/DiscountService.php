<?php

namespace App\Services;

use App\Models\Discount;
use App\User;

class DiscountService
{
    public function giveDiscountForCreateDate(User $user)
    {
        if ($user->created_at->diffInDays() != 365 && !($user->discounts()->get()->all())) {
            Discount::create([
                'user_id' => $user->id,
                'discount' => 15
            ]);
        }

    }
}
