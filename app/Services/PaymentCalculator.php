<?php

namespace App\Services;

use Exception;

class PaymentCalculator
{
    public function calculatePayment(int $bill, int $price, int $discount)
    {
        $result = $bill - ($price - ($price * ($discount / 100)));

        if($result < 0)
        {
            throw new Exception('Not enough money to rent', 400);
        }

        return $result;
    }
}
